<?php
/**
 * Plugin Name: HWH CSV Importer
 * Plugin URI: https://hotwaterheroesplumbing.com
 * Description: Bulk-update any WordPress post data from a CSV — titles, content, excerpts, slugs, Yoast SEO fields, and any custom meta. Match by post ID.
 * Version: 2.0
 * Author: Hot Water Heroes
 * Author URI: https://hotwaterheroesplumbing.com
 * License: GPL v2 or later
 */

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', function() {
    add_management_page( 'HWH CSV Importer', 'HWH CSV Importer', 'manage_options', 'hwh-csv-importer', 'hwh_csv_importer_page' );
});

add_action( 'admin_enqueue_scripts', function( $hook ) {
    if ( $hook !== 'tools_page_hwh-csv-importer' ) return;
    wp_add_inline_style( 'wp-admin', '
        .hwh-wrap{max-width:960px}.hwh-map{background:#f9f9f9;border:1px solid #ddd;padding:16px;border-radius:6px;margin:16px 0}
        .hwh-map th{text-align:left;padding:6px 8px;background:#e9e9e9}.hwh-map td{padding:6px 8px}
        .hwh-b-post{background:#2271b1;color:#fff;padding:2px 8px;border-radius:3px;font-size:12px}
        .hwh-b-meta{background:#8c5e00;color:#fff;padding:2px 8px;border-radius:3px;font-size:12px}
        .hwh-b-skip{background:#999;color:#fff;padding:2px 8px;border-radius:3px;font-size:12px}
        .hwh-ok{color:#0a7c2e;font-weight:600}.hwh-skip{color:#999}
    ');
});

function hwh_post_field_map() {
    return ['title'=>'post_title','post_title'=>'post_title','content'=>'post_content','post_content'=>'post_content',
        'excerpt'=>'post_excerpt','post_excerpt'=>'post_excerpt','slug'=>'post_name','post_name'=>'post_name',
        'status'=>'post_status','post_status'=>'post_status','post_date'=>'post_date','post_type'=>'__skip__'];
}

function hwh_csv_importer_page() {
    $results = $preview = null; $csv_data = null; $step = 'upload';

    if ( isset($_POST['hwh_preview_nonce']) && wp_verify_nonce($_POST['hwh_preview_nonce'],'hwh_preview') && !empty($_FILES['csv_file']['tmp_name']) ) {
        $csv_data = hwh_parse_csv($_FILES['csv_file']['tmp_name']);
        if (is_string($csv_data)) { $preview = $csv_data; } else { $step = 'preview'; set_transient('hwh_csv_data',$csv_data,600); }
    }
    if ( isset($_POST['hwh_import_nonce']) && wp_verify_nonce($_POST['hwh_import_nonce'],'hwh_import') ) {
        $csv_data = get_transient('hwh_csv_data');
        if ($csv_data) { $results = hwh_run_import($csv_data); delete_transient('hwh_csv_data'); $step = 'results'; }
    }
    ?>
    <div class="wrap hwh-wrap">
    <h1>🔧 HWH CSV Importer</h1>
    <p>Bulk-update posts, pages, or services from a CSV. Supports titles, content, excerpts, slugs, and any Yoast/custom meta.</p><hr>

    <?php if ($step==='upload'): ?>
        <h2>Step 1: Upload CSV</h2>
        <p>CSV must have an <code>id</code> column. Other columns auto-map:</p>
        <ul style="list-style:disc;margin-left:20px">
            <li><b>Title, Content, Excerpt, Slug, Status</b> → post fields</li>
            <li><b>_yoast_wpseo_title, _yoast_wpseo_metadesc</b> → Yoast SEO</li>
            <li><b>Any other column</b> → custom meta</li>
        </ul>
        <?php if(is_string($preview)):?><div class="notice notice-error"><p><?php echo esc_html($preview);?></p></div><?php endif;?>
        <form method="post" enctype="multipart/form-data">
            <?php wp_nonce_field('hwh_preview','hwh_preview_nonce');?>
            <table class="form-table"><tr><th><label for="csv_file">CSV File</label></th>
            <td><input type="file" name="csv_file" id="csv_file" accept=".csv" required></td></tr></table>
            <?php submit_button('Upload & Preview');?>
        </form>

    <?php elseif ($step==='preview'): $fm=hwh_post_field_map(); ?>
        <h2>Step 2: Preview</h2>
        <div class="hwh-map"><h3>📋 Column Mapping</h3><table><tr><th>CSV Column</th><th>Maps To</th><th>Type</th></tr>
        <?php foreach($csv_data['headers'] as $h): if(strtolower($h)==='id') continue; $l=strtolower($h);
            if(isset($fm[$l])&&$fm[$l]==='__skip__'):?>
                <tr><td><code><?php echo esc_html($h);?></code></td><td><em>Skipped</em></td><td><span class="hwh-b-skip">Skip</span></td></tr>
            <?php elseif(isset($fm[$l])):?>
                <tr><td><code><?php echo esc_html($h);?></code></td><td><code><?php echo esc_html($fm[$l]);?></code></td><td><span class="hwh-b-post">Post Field</span></td></tr>
            <?php else:?>
                <tr><td><code><?php echo esc_html($h);?></code></td><td><code><?php echo esc_html($h);?></code></td><td><span class="hwh-b-meta">Custom Meta</span></td></tr>
        <?php endif; endforeach;?></table></div>

        <div style="background:#fff8e5;border:1px solid #ecc94b;padding:12px;border-radius:6px;margin:12px 0">
        <h3>👀 Preview (first 5 rows)</h3>
        <table class="widefat striped"><thead><tr><?php foreach($csv_data['headers'] as $h):?><th><?php echo esc_html($h);?></th><?php endforeach;?></tr></thead>
        <tbody><?php foreach(array_slice($csv_data['rows'],0,5) as $row):?><tr><?php foreach($row as $v):?><td><?php echo esc_html(mb_strimwidth($v,0,80,'...'));?></td><?php endforeach;?></tr><?php endforeach;?></tbody></table>
        <p><b><?php echo count($csv_data['rows']);?> total rows</b></p></div>

        <form method="post"><?php wp_nonce_field('hwh_import','hwh_import_nonce'); submit_button('🚀 Confirm & Import');?></form>
        <p><a href="<?php echo admin_url('tools.php?page=hwh-csv-importer');?>">← Back</a></p>

    <?php elseif ($step==='results'):?>
        <h2>Step 3: Results</h2>
        <div class="notice notice-success"><p><b>✅ Import complete!</b> <?php echo count($results);?> rows processed.</p></div>
        <table class="widefat striped"><thead><tr><th>ID</th><th>Title</th><th>Post Fields</th><th>Meta Fields</th><th>Status</th></tr></thead>
        <tbody><?php foreach($results as $r):?><tr>
            <td><?php echo esc_html($r['id']);?></td><td><?php echo esc_html($r['title']);?></td>
            <td><?php echo esc_html($r['pf']);?></td><td><?php echo esc_html($r['mf']);?></td>
            <td class="<?php echo $r['ok']?'hwh-ok':'hwh-skip';?>"><?php echo esc_html($r['st']);?></td>
        </tr><?php endforeach;?></tbody></table>
        <p><a href="<?php echo admin_url('tools.php?page=hwh-csv-importer');?>" class="button">Import Another</a></p>
    <?php endif;?>
    </div><?php
}

function hwh_parse_csv($path) {
    $h=fopen($path,'r'); if(!$h) return 'Cannot open file.';
    $headers=fgetcsv($h); if(!$headers) return 'Empty CSV.';
    $headers[0]=preg_replace('/^\xEF\xBB\xBF/','',$headers[0]);
    $headers=array_map('trim',$headers);
    $found=false; foreach($headers as $x) if(strtolower($x)==='id'){$found=true;break;}
    if(!$found) return 'No "id" column found.';
    $rows=[]; while(($r=fgetcsv($h))!==false){while(count($r)<count($headers))$r[]='';$rows[]=$r;}
    fclose($h); if(empty($rows)) return 'No data rows.';
    return ['headers'=>$headers,'rows'=>$rows];
}

function hwh_run_import($d) {
    $headers=$d['headers'];$rows=$d['rows'];$fm=hwh_post_field_map();$results=[];
    $idi=null; foreach($headers as $i=>$h) if(strtolower($h)==='id'){$idi=$i;break;}

    foreach($rows as $row) {
        $pid=intval($row[$idi]); if(!$pid) continue;
        $post=get_post($pid);
        if(!$post){$results[]=['id'=>$pid,'title'=>'(not found)','pf'=>'-','mf'=>'-','st'=>'SKIPPED','ok'=>false];continue;}

        $pu=[]; $mu=[];
        foreach($headers as $i=>$header) {
            if($i===$idi) continue;
            $v=isset($row[$i])?$row[$i]:''; if($v==='') continue;
            $l=strtolower(trim($header));
            if(isset($fm[$l])){
                if($fm[$l]==='__skip__') continue;
                $pu[$fm[$l]]=$v;
            } else {
                update_post_meta($pid,trim($header),$v); $mu[]=trim($header);
            }
        }
        if(!empty($pu)){$pu['ID']=$pid;wp_update_post($pu);}
        $results[]=['id'=>$pid,'title'=>get_the_title($pid),
            'pf'=>!empty($pu)?implode(', ',array_diff(array_keys($pu),['ID'])):'—',
            'mf'=>!empty($mu)?implode(', ',$mu):'—',
            'st'=>(!empty($pu)||!empty($mu))?'✅ Updated':'— No changes','ok'=>(!empty($pu)||!empty($mu))];
    }
    return $results;
}
