<?php
/**
 * Restowrx Elite — Bulk Service Page Seeder
 * Programmatically inserts 80 localized services and subcategory pages (16 core services x 5 locations).
 * Generates unique local SEO content dynamically for each page.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

function rwx_seed_bulk_services() {
    // 1. Double check permission
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'Access denied: Administrator permissions required.' );
    }

    // 2. Check or set execution option (allows running seeder multiple times but skips existing posts)
    $mit_term = term_exists( 'Mitigation & Recovery', 'service_category' );
    if ( ! $mit_term ) {
        $mit_term = wp_insert_term( 'Mitigation & Recovery', 'service_category', [ 'slug' => 'mitigation-recovery' ] );
    }
    $mit_cat_id = ( $mit_term && ! is_wp_error( $mit_term ) ) ? ( is_array( $mit_term ) ? $mit_term['term_id'] : (int) $mit_term ) : 0;

    // 3. Define 16 Core Services and Subcategories
    $services = [
        // --- WATER DAMAGE ---
        [
            'title'    => 'Water Damage Restoration',
            'slug'     => 'water-damage-restoration',
            'parent'   => 'Water Damage Restoration',
            'price'    => 'Direct Insurance Billing',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Emergency Water Extraction',
            'slug'     => 'emergency-water-extraction',
            'parent'   => 'Water Damage Restoration',
            'price'    => 'Direct Insurance Billing',
            'duration' => '45-Min Dispatch'
        ],
        [
            'title'    => 'Flooded Basement Cleanup',
            'slug'     => 'flooded-basement-cleanup',
            'parent'   => 'Water Damage Restoration',
            'price'    => 'Xactimate Pricing',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Sewage Cleanup & Sanitization',
            'slug'     => 'sewage-cleanup-sanitization',
            'parent'   => 'Water Damage Restoration',
            'price'    => 'Biohazard Covered',
            'duration' => '45-Min Dispatch'
        ],
        [
            'title'    => 'Water Leak Repair',
            'slug'     => 'water-leak-repair',
            'parent'   => 'Water Damage Restoration',
            'price'    => 'Free Leak Estimate',
            'duration' => 'Scheduled Dispatch'
        ],

        // --- STORM DAMAGE ---
        [
            'title'    => 'Storm Damage Restoration',
            'slug'     => 'storm-damage-restoration',
            'parent'   => 'Storm Damage Restoration',
            'price'    => 'Insurance Covered',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Hurricane & Wind Damage Cleanup',
            'slug'     => 'hurricane-wind-damage-cleanup',
            'parent'   => 'Storm Damage Restoration',
            'price'    => 'Direct Tarp Billing',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Emergency Board-Up & Tarping',
            'slug'     => 'emergency-board-up-tarping',
            'parent'   => 'Storm Damage Restoration',
            'price'    => 'Mitigation Covered',
            'duration' => '45-Min Dispatch'
        ],
        [
            'title'    => 'Debris & Tree Removal',
            'slug'     => 'debris-tree-removal',
            'parent'   => 'Storm Damage Restoration',
            'price'    => 'Free Estimate',
            'duration' => 'Scheduled Dispatch'
        ],

        // --- FIRE DAMAGE ---
        [
            'title'    => 'Fire & Smoke Damage Restoration',
            'slug'     => 'fire-damage-restoration',
            'parent'   => 'Fire Damage Restoration',
            'price'    => 'Direct Adjuster Billing',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Smoke & Soot Cleanup',
            'slug'     => 'smoke-soot-cleanup',
            'parent'   => 'Fire Damage Restoration',
            'price'    => 'Mitigation Covered',
            'duration' => '60-Min Dispatch'
        ],
        [
            'title'    => 'Fire Damage Repair & Reconstruction',
            'slug'     => 'fire-damage-repair-reconstruction',
            'parent'   => 'Fire Damage Restoration',
            'price'    => 'Free Structural Estimate',
            'duration' => 'Scheduled Dispatch'
        ],
        [
            'title'    => 'Odor Deodorization & Sanitization',
            'slug'     => 'odor-deodorization-sanitization',
            'parent'   => 'Fire Damage Restoration',
            'price'    => 'Free Odor Estimate',
            'duration' => 'Scheduled Dispatch'
        ],

        // --- MOLD REMEDIATION ---
        [
            'title'    => 'Mold Remediation & Removal',
            'slug'     => 'mold-remediation',
            'parent'   => 'Mold Remediation & Removal',
            'price'    => 'Certified Inspection',
            'duration' => 'Scheduled Dispatch'
        ],
        [
            'title'    => 'Black Mold Removal',
            'slug'     => 'black-mold-removal',
            'parent'   => 'Mold Remediation & Removal',
            'price'    => 'Containment Covered',
            'duration' => 'Scheduled Dispatch'
        ],
        [
            'title'    => 'Mold Inspection & Testing',
            'slug'     => 'mold-inspection-testing',
            'parent'   => 'Mold Remediation & Removal',
            'price'    => 'Assessor Testing',
            'duration' => 'Scheduled Dispatch'
        ],
        [
            'title'    => 'Crawlspace Mold Remediation',
            'slug'     => 'crawlspace-mold-remediation',
            'parent'   => 'Mold Remediation & Removal',
            'price'    => 'Encapsulation Estimate',
            'duration' => 'Scheduled Dispatch'
        ]
    ];

    // 4. Define 5 locations (Main + 4 Neighborhoods)
    $locations = [
        [ 'key' => 'tampa',          'name' => 'Tampa (Main)',      'suffix' => '' ],
        [ 'key' => 'south-tampa',    'name' => 'South Tampa',       'suffix' => 'South Tampa' ],
        [ 'key' => 'brandon',        'name' => 'Brandon',           'suffix' => 'Brandon' ],
        [ 'key' => 'st-petersburg',  'name' => 'St. Petersburg',    'suffix' => 'St. Petersburg' ],
        [ 'key' => 'carrollwood',    'name' => 'Carrollwood',       'suffix' => 'Carrollwood' ]
    ];

    $results = [];

    // 5. Database Loop
    foreach ( $services as $s ) {
        foreach ( $locations as $l ) {
            // Construct Slug
            $slug = ($l['key'] === 'tampa') ? $s['slug'] : $s['slug'] . '-' . $l['key'];
            
            // Construct Title
            $title = empty($l['suffix']) ? $s['title'] : $s['title'] . ' ' . $l['suffix'];

            // Check if post exists by slug (post_name)
            $existing = new WP_Query([
                'post_type'      => 'service',
                'name'           => $slug,
                'posts_per_page' => 1,
                'fields'         => 'ids',
                'post_status'    => 'any',
            ]);

            if ( $existing->have_posts() ) {
                $post_id = $existing->posts[0];
                $results[] = [
                    'slug'   => $slug,
                    'title'  => $title,
                    'status' => 'SKIPPED (Exists, ID: ' . $post_id . ')',
                    'ok'     => false,
                ];
                continue;
            }

            // Generate content dynamically
            $content = rwx_compile_service_content( $s['slug'], $l['key'], $s['title'], $s['parent'] );

            // Yoast SEO parameters
            $seo_title = ($l['key'] === 'tampa') ? $s['title'] . ' Tampa | Restowrx Elite' : $s['title'] . ' ' . $l['name'] . ' | Restowrx Elite';
            $seo_desc = ($l['key'] === 'tampa') ? 'Need expert ' . strtolower($s['title']) . ' in Tampa? Restowrx Elite offers 24/7 emergency dispatch. Call (813) 699-4009.' : 'Need expert ' . strtolower($s['title']) . ' in ' . $l['name'] . ', FL? Restowrx Elite offers 24/7 emergency recovery. Call (813) 699-4009.';
            $focuskw = ($l['key'] === 'tampa') ? strtolower($s['title']) . ' Tampa' : strtolower($s['title']) . ' ' . $l['name'];

            // Insert new post as DRAFT
            $post_data = [
                'post_title'   => $title,
                'post_name'    => $slug,
                'post_content' => $content,
                'post_excerpt' => $s['title'] . ' services in ' . $l['name'] . ', FL. Professional property recovery, 24/7 support.',
                'post_status'  => 'draft',
                'post_type'    => 'service',
            ];

            $post_id = wp_insert_post( $post_data );

            if ( is_wp_error( $post_id ) ) {
                $results[] = [
                    'slug'   => $slug,
                    'title'  => $title,
                    'status' => 'ERROR: ' . $post_id->get_error_message(),
                    'ok'     => false,
                ];
                continue;
            }

            // Set category
            if ( $mit_cat_id ) {
                wp_set_object_terms( $post_id, [ $mit_cat_id ], 'service_category' );
            }

            // Add custom meta fields
            update_post_meta( $post_id, '_service_price', $s['price'] );
            update_post_meta( $post_id, '_service_duration', $s['duration'] );

            // Add Yoast SEO fields
            update_post_meta( $post_id, '_yoast_wpseo_title', $seo_title );
            update_post_meta( $post_id, '_yoast_wpseo_metadesc', $seo_desc );
            update_post_meta( $post_id, '_yoast_wpseo_focuskw', $focuskw );

            $results[] = [
                'slug'   => $slug,
                'title'  => $title,
                'status' => 'CREATED (ID: ' . $post_id . ')',
                'ok'     => true,
            ];
        }
    }

    // 6. Set option
    update_option( 'rwx_services_seeded_v3', true );

    // 7. Output Results
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Restowrx Bulk Seeder Results</title>
        <style>
            body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background: #f0f2f5; padding: 45px; color: #1c1e21; }
            .card { background: #fff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 900px; margin: 0 auto; padding: 30px; }
            h1 { color: #a31d24; margin-top: 0; font-size: 28px; border-bottom: 2px solid #f0f2f5; padding-bottom: 15px; }
            table { width: 100%; border-collapse: collapse; margin-top: 20px; font-size: 13px; }
            th, td { text-align: left; padding: 8px 10px; border-bottom: 1px solid #e4e6eb; }
            th { background: #f4f6f9; font-weight: 600; }
            .status-ok { color: #00875a; font-weight: bold; }
            .status-skip { color: #5e6c84; }
            .btn { display: inline-block; background: #a31d24; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: 600; margin-top: 25px; transition: background 0.2s; }
            .btn:hover { background: #82141a; }
            .scroll-table { max-height: 500px; overflow-y: scroll; border: 1px solid #e4e6eb; margin-top: 20px; border-radius: 4px; }
            .alert { background: #fff8e6; border-left: 4px solid #ffab00; padding: 15px; margin-top: 20px; border-radius: 0 4px 4px 0; font-size: 14px; line-height: 1.5; }
        </style>
    </head>
    <body>
        <div class="card">
            <h1>🔧 Restowrx Elite — Bulk Service Seeder</h1>
            <p>The seeder has completed database operations. Below are the results of the 80 target pages:</p>
            
            <div class="scroll-table">
                <table>
                    <thead>
                        <tr>
                            <th>Page Title</th>
                            <th>Slug</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ( $results as $r ): ?>
                            <tr>
                                <td><strong><?php echo esc_html( $r['title'] ); ?></strong></td>
                                <td><code><?php echo esc_html( $r['slug'] ); ?></code></td>
                                <td class="<?php echo $r['ok'] ? 'status-ok' : 'status-skip'; ?>">
                                    <?php echo esc_html( $r['status'] ); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="alert">
                <strong>✅ Next Step: Code Cleanup Required</strong><br>
                All draft pages have been seeded. Please check your WordPress Admin under <strong>Services</strong>. Once you verify that they are correct, notify Antigravity in the chat so the temporary trigger hook and seeder script can be safely deleted.
            </div>

            <a href="<?php echo esc_url( admin_url( 'edit.php?post_type=service' ) ); ?>" class="btn">Go to Services in Admin</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

/**
 * Helper Content Compiler
 */
function rwx_compile_service_content( $slug, $location_key, $service_title, $parent_title ) {
    // Determine location parameters
    $locName = 'Tampa';
    $locCounty = 'Hillsborough County';
    $locLandmarks = 'Ybor City, Tampa Heights, and the downtown business district';
    $locDetails = 'intense Florida humidity, summer storms, and high local water tables';
    $southTampaZips = ['33629', '33611', '33606', '33609', '33616', '33621'];
    
    if ( $location_key === 'brandon' ) {
        $locName = 'Brandon';
        $locCounty = 'Hillsborough County';
        $locLandmarks = 'Brandon Parkway, the Bloomingdale area, Brandon Town Center, and the Alafia River basin';
        $locDetails = 'suburban expansion homes, slab leaks, and river runoff flooding';
    } elseif ( $location_key === 'st-petersburg' ) {
        $locName = 'St. Petersburg';
        $locCounty = 'Pinellas County';
        $locLandmarks = 'Old Northeast, Snell Isle, Shore Acres, and Historic Kenwood';
        $locDetails = 'coastal surges, historic lath-and-plaster wood frames, and wind-load weather protection';
    } elseif ( $location_key === 'south-tampa' ) {
        $locName = 'South Tampa';
        $locCounty = 'Hillsborough County';
        $locLandmarks = 'Bayshore Boulevard, Hyde Park, Davis Islands, and Palma Ceia';
        $locDetails = 'historic bungalows, cast-iron plumbing failures, and coastal tidal surges';
    } elseif ( $location_key === 'carrollwood' ) {
        $locName = 'Carrollwood';
        $locCounty = 'Hillsborough County';
        $locLandmarks = 'Carrollwood Village, Lake Carroll, Dale Mabry Corridor, and Lake Ellen';
        $locDetails = 'lakefront property humidity, custom cabinetry leaks, and aging residential plumbing';
    }

    // Determine service category based on slug
    $category = 'water';
    if ( strpos( $slug, 'mold' ) !== false ) {
        $category = 'mold';
    } elseif ( strpos( $slug, 'fire' ) !== false || strpos( $slug, 'smoke' ) !== false || strpos( $slug, 'soot' ) !== false || strpos( $slug, 'odor' ) !== false ) {
        $category = 'fire';
    } elseif ( strpos( $slug, 'storm' ) !== false || strpos( $slug, 'board' ) !== false || strpos( $slug, 'tarp' ) !== false || strpos( $slug, 'debris' ) !== false || strpos( $slug, 'hurricane' ) !== false || strpos( $slug, 'wind' ) !== false ) {
        $category = 'storm';
    }

    $introText = "";
    $whyNeedText = "";
    $concernsTitle = "Common Warning Signs";
    $concernsList = [];
    $solutionsTitle = "Our Tactical Solutions";
    $solutionsList = [];
    $eeatText = "";
    $costText = "";
    $processSteps = [];
    $faqs = [];

    // Populate arrays
    if ( $category === 'water' ) {
        $introText = "When water damage compromises your property, immediate action is required to halt structural decay and prevent biological growth. In {$locName}, water intrusion can saturate drywall, wood framing, and flooring rapidly. Our IICRC-certified response teams deploy with commercial-grade water extraction pumps, thermal imaging cameras, and LGR dehumidifiers to dry and restore your residential or commercial space with surgical precision.";
        $whyNeedText = "Properties in the {$locName} area are highly vulnerable to {$locDetails}. Trying to dry structural water with domestic fans leaves deep-seated moisture trapped behind walls, leading to wood rot, swelling, and mold growth. Professional water damage mitigation detects hidden moisture channels and runs scientific drying arrays to restore the property to dry-standard compliance.";
        $concernsTitle = "Common Water Damage Warning Signs";
        $concernsList = [
            "Warping, bubbling paint, or yellow stains along lower walls and baseboards.",
            "Musty, damp, or sour odors venting from wall cavities or HVAC ducts.",
            "Buckling hardwood planks, separating laminate seams, or lifting floor tiles.",
            "Water spots, sagging drywall ceilings, or active leaking from upper floors."
        ];
        $solutionsTitle = "Our Comprehensive Water Mitigation Solutions";
        $solutionsList = [
            "<strong>24/7 Water Extraction:</strong> High-powered truck-mounted pumps removing thousands of gallons of standing water.",
            "<strong>Thermal Imaging & Mapping:</strong> Locating moisture pockets hidden behind masonry, framing, and insulation.",
            "<strong>LGR Dehumidification:</strong> Rapidly lowering relative humidity to accelerate evaporation from wet structural materials.",
            "<strong>Biohazard Sanitizing:</strong> Full chemical flushing, disinfecting, and odor neutralization for Category 3 sewage backflows."
        ];
        $eeatText = "Restowrx Elite is a licensed property restoration contractor in Florida. Our technicians hold advanced certifications from the IICRC in water damage restoration (WRT) and applied structural drying (ASD). We coordinate directly with your homeowners insurance provider, logging daily moisture readings to secure claim approvals smoothly.";
        $costText = "Water mitigation costs in {$locName} range from $1,500 to $5,000+ depending on the class of water intrusion and square footage affected. Because emergency dryouts prevent catastrophic structural failure, they are typically fully covered by standard property insurance. We offer direct insurance billing to minimize your stress.";
        $processSteps = [
            "<strong>Phase 1: Inspection & Thermal Mapping:</strong> We define the exact boundary of moisture and isolate the affected areas.",
            "<strong>Phase 2: High-Volume Extraction:</strong> We extract standing water from all floors, subfloors, and slabs.",
            "<strong>Phase 3: Drying Equipment Placement:</strong> We deploy industrial air movers and LGR dehumidifiers to dry structural framing.",
            "<strong>Phase 4: Monitoring & Sanitation:</strong> We track drying progress daily, apply EPA-registered antimicrobials, and clear the site for rebuild."
        ];
        $faqs = [
            [
                'q' => 'Does insurance cover ' . $service_title . ' in ' . $locName . '?',
                'a' => 'Yes, sudden and accidental water damage (such as pipe leaks, plumbing overflows, or water heater failures) is typically covered by standard property policies. We bill your insurance provider directly.'
            ],
            [
                'q' => 'How long does a property take to dry?',
                'a' => 'A standard structural dry-out takes between 3 to 5 days. Hardwood floors, concrete slabs, and crawlspaces may require specialized drying equipment and take slightly longer.'
            ],
            [
                'q' => 'Will mold grow if I wait to start cleanup?',
                'a' => 'Yes. Mold spores colonize and grow within 24 to 48 hours of water exposure in Florida\'s humid climate. Prompt extraction and dehumidification are critical to prevent mold infestation.'
            ]
        ];
    } elseif ( $category === 'mold' ) {
        $introText = "Mold colonization compromises indoor air quality and structural integrity in Florida’s humid environment. In {$locName}, mold spores find ideal growing conditions whenever moisture remains unchecked. At Restowrx Elite, we provide certified mold remediation and black mold removal. We construct negative-pressure containment zones, scrub the air with HEPA filtration, and physically remediate mold roots to restore your property’s health.";
        $whyNeedText = "In {$locName}, trying to spray bleach on moldy drywall is a critical mistake; bleach cannot penetrate porous materials and the water content actually feeds mold roots. Safe mold remediation requires strict containment to isolate spores, physical extraction of contaminated materials, and certified air scrubbing. Under Florida law (§ 468.84), remediation must maintain a strict division from assessment to protect consumers.";
        $concernsTitle = "Warning Signs of Mold Infestation";
        $concernsList = [
            "Visible dark green, black, or grey patches spreading on drywall, baseboards, or cabinetry.",
            "A persistent musty, earthy, or damp smell that gets stronger when the AC is running.",
            "Recurring allergy symptoms, nasal congestion, coughing, or respiratory irritation when inside.",
            "Failed home inspections due to mold growth, stalling real estate transactions."
        ];
        $solutionsTitle = "Our Mold Remediation & Cleanout Solutions";
        $solutionsList = [
            "<strong>Negative Pressure Containment:</strong> Isolating work zones with airtight plastic barriers to contain spores.",
            "<strong>HEPA Air Filtration:</strong> Continuously scrubbing the air to trap microscopic mold spores and dust particles.",
            "<strong>Physical Remediation & Sanding:</strong> Sanding structural wood framing and applying mold-resistant coatings.",
            "<strong>HVAC System Disinfection:</strong> Sanitizing air handlers, coils, and ductwork to prevent spore recirculation."
        ];
        $eeatText = "Our remediation specialists are fully licensed in the State of Florida and certified by the IICRC as Applied Microbial Remediation Technicians (AMRT). We partner with independent, licensed mold assessors to perform pre- and post-remediation testing, ensuring that a certified laboratory clearance report verifies your home’s air is safe.";
        $costText = "Mold remediation in {$locName} typically ranges from $1,200 to $8,000+ depending on the containment size, accessibility, and structural materials affected. We provide fully itemized quotes and help you navigate insurance coverage if the mold resulted from a covered water leak.";
        $processSteps = [
            "<strong>Step 1: Containment Construction:</strong> We build plastic airlocks and set up negative air machines to protect the rest of the property.",
            "<strong>Step 2: Controlled Material Removal:</strong> We bag and remove contaminated drywall, carpet, and trim under negative pressure.",
            "<strong>Step 3: Physical Remediation & Sanding:</strong> We brush and sand remaining framing wood, followed by HEPA vacuuming and antimicrobial application.",
            "<strong>Step 4: Clearance Testing & Containment Drop:</strong> An independent inspector takes air samples. Once the lab clearance is issued, we tear down containment."
        ];
        $faqs = [
            [
                'q' => 'Can I clean mold myself with bleach?',
                'a' => 'No. Bleach is mostly water. On porous materials like drywall, wood, or carpet, the chlorine stays on the surface while the water sinks in, which actually feeds the mold roots and causes it to return stronger.'
            ],
            [
                'q' => 'Do I need a mold test before removing it?',
                'a' => 'While not always required, pre-testing by an independent mold assessor is highly recommended to document spore levels and create a remediation protocol. Post-testing is crucial to prove the air is safe.'
            ],
            [
                'q' => 'How long does mold remediation take?',
                'a' => 'Most mold remediation projects take 3 to 5 days, which includes setting up containment, physical cleaning, and waiting for the independent lab to process the post-remediation air clearance samples.'
            ]
        ];
    } elseif ( $category === 'fire' ) {
        $introText = "Property fires cause sudden devastation, leaving behind structural damage, acidic soot residue, and toxic smoke odors. In {$locName}, the hours following a fire are critical. Soot is corrosive and will chemically etch metals, stone, and glass within days. At Restowrx Elite, our fire damage restoration teams deploy immediately to secure the structure, board up openings, clean soot, and neutralize smoke odor at the molecular level.";
        $whyNeedText = "Fire restoration requires a specialized chemical cleaning process. Soot particles are microscopic, sticky, and highly acidic. Standard cleaning smears the soot, trapping acrid smoke smells in the drywall. Additionally, water used to extinguish the fire triggers an immediate risk of mold growth. Professional mitigation handles both soot cleanup and rapid structural drying to prevent secondary rot in {$locName}’s humid air.";
        $concernsTitle = "Signs of Fire & Smoke Damage";
        $concernsList = [
            "Acidic soot coatings covering countertops, walls, and tarnishable metal fixtures.",
            "Heavy, acrid smoke odor deeply embedded in wood framing, carpets, and air ducts.",
            "Charred or structurally compromised wall framing, floor joists, or roof trusses.",
            "High humidity, standing water, and chemical foam pooling from fire suppression."
        ];
        $solutionsTitle = "Our Fire & Smoke Mitigation Services";
        $solutionsList = [
            "<strong>Emergency Board-Up & Tarping:</strong> Securing broken windows, doors, and roofs to protect against weather and theft.",
            "<strong>Soot Chemical Washing:</strong> Using specialized dry-sponges and soot-releasing compounds to clean surfaces safely.",
            "<strong>Ozone & Hydroxyl Deodorization:</strong> Breaking down complex smoke odor molecules in the air and framing wood.",
            "<strong>Structural Stabilization & Drying:</strong> Drying structural framing saturated by fire hoses and stabilizing framing."
        ];
        $eeatText = "Our technicians are certified by the IICRC in fire and smoke restoration (FSRT) and odor control (OCT). In cases of structural rebuild, we coordinate with our partner general contractor, **Spicola Construction**, to manage building permits, structural inspections, and complete framing, drywall, and finish reconstruction.";
        $costText = "Fire restoration costs in {$locName} vary from $5,000 for minor kitchen soot cleanups to $100,000+ for whole-home structural rebuilds. Fire damage is a standard covered peril on property insurance. We write our estimates in Xactimate and handle direct insurance billing to minimize your financial burden.";
        $processSteps = [
            "<strong>Phase 1: Board-Up & Secure:</strong> We seal off windows, doors, and roofs to protect the home from elements and trespassers.",
            "<strong>Phase 2: Water Pumping & Cleanup:</strong> We extract fire-hose water and clean up charred structural debris.",
            "<strong>Phase 3: Soot Cleaning & Washing:</strong> We hand-clean soot from all structural and cosmetic surfaces with specialized sponges.",
            "<strong>Phase 4: Odor Neutralization & Sealing:</strong> We run ozone/hydroxyl generators to eliminate smoke smells and apply odor-blocking primers."
        ];
        $faqs = [
            [
                'q' => 'Can I clean the soot myself?',
                'a' => 'No. Soot is greasy and highly acidic. Standard cleaning wipes will smear soot into drywall pores, turning it grey and sealing the smell in. Specialized chemical soot sponges are required to pull soot off surfaces.'
            ],
            [
                'q' => 'How do you remove the smoke smell?',
                'a' => 'We use industrial ozone and hydroxyl generators. These machines release reactive molecules that bind to and break down the smoke compounds inside wood and drywall pores, neutralizing the odor at its source.'
            ],
            [
                'q' => 'Is fire damage restoration covered by insurance?',
                'a' => 'Yes. Property fires and smoke damage are standard covered perils under almost all homeowners and commercial insurance policies. We work directly with your adjuster to manage the claim.'
            ]
        ];
    } elseif ( $category === 'storm' ) {
        $introText = "Severe Florida weather, high winds, and hurricanes can compromise a property’s envelope in seconds. In {$locName}, storm damage requires immediate emergency stabilization to prevent massive secondary water damage from rainfall. At Restowrx Elite, we deploy emergency response crews to board up windows, trap roofs, shore up compromised walls, and clear fallen trees and storm debris from your property.";
        $whyNeedText = "When a storm damages your roof or windows in {$locName}, water pours in, saturating your home. Under insurance guidelines, property owners have a legal duty to mitigate damage immediately. Professional board-up, tarping, and debris clearing secure your building envelope, prevent trespassing, and ensure that your insurance claim is not delayed or denied due to neglected secondary damage.";
        $concernsTitle = "Common Storm Damage Warning Signs";
        $concernsList = [
            "Missing shingles, metal panels, or compromised roof decking allowing water entry.",
            "Shattered window glass, damaged sliding doors, or blown-in entry doors.",
            "Fallen tree limbs, structural debris blocking access, or leaning framing studs.",
            "Flooding from heavy rains or storm surges saturating lower floors."
        ];
        $solutionsTitle = "Our Emergency Storm Response Services";
        $solutionsList = [
            "<strong>Roof Tarping & Shrink-Wrap:</strong> Sealing damaged roofs with heavy-duty tarps to prevent rain from entering.",
            "<strong>Emergency Window Board-Up:</strong> Securing broken windows and sliding glass doors with custom-cut plywood panels.",
            "<strong>Debris & Tree Removal:</strong> Clearing fallen trees, limbs, and storm debris to restore safe access to the site.",
            "<strong>Structural Shoring:</strong> Erecting temporary support beams to stabilize wind-damaged walls or roofs."
        ];
        $eeatText = "We are local Florida contractors experienced in hurricane recovery. We coordinate directly with Spicola Construction (general contracting CGC license) to execute structural repairs, replace wind-damaged roofs, and handle county permitting, ensuring your home meets strict Florida wind-load standards.";
        $costText = "Emergency storm tarping and board-up in {$locName} typically ranges from $800 to $4,500 depending on the size and heights involved. These stabilization services are fully covered by property insurance as emergency mitigation. We provide Xactimate billing and direct claim coordination.";
        $processSteps = [
            "<strong>Phase 1: Hazard Assessment:</strong> We assess power lines, trees, and structural stability to ensure a safe work zone.",
            "<strong>Phase 2: Envelope Stabilization:</strong> We board up windows, secure entryways, and install heavy-duty roof tarps.",
            "<strong>Phase 3: Debris & Tree Clearing:</strong> We remove fallen trees, branches, and storm wreckage from the building exterior.",
            "<strong>Phase 4: Moisture Control & Rebuild Plan:</strong> We extract water from storm leaks and draft a complete reconstruction proposal."
        ];
        $faqs = [
            [
                'q' => 'What is my duty to mitigate after a storm in ' . $locName . '?',
                'a' => 'Insurance policies require you to take immediate reasonable steps to protect your property from further damage after a storm. This includes boarding up broken windows and tarping roofs. Failing to do so can result in denial of secondary water damage claims.'
            ],
            [
                'q' => 'Can you clear trees that have fallen on my house?',
                'a' => 'Yes. We provide emergency tree removal, utilizing crane services if necessary to lift heavy logs off roofs and walls safely without causing further structural damage.'
            ],
            [
                'q' => 'Will my insurance cover storm damage board-up?',
                'a' => 'Yes. Standard homeowners and commercial policies cover the cost of emergency board-up and roof tarping under the mitigation clause of the policy. We bill your insurance directly.'
            ]
        ];
    }

    // Construct HTML string
    $html = "<!-- wp:paragraph -->\n";
    $html .= "<p>{$introText}</p>\n";
    $html .= "<!-- /wp:paragraph -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2><strong>Why {$locName} Properties Need Professional {$service_title}</strong></h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:paragraph -->\n";
    $html .= "<p>{$whyNeedText}</p>\n";
    $html .= "<!-- /wp:paragraph -->\n\n";

    $html .= "<!-- wp:heading {\"level\":3} -->\n";
    $html .= "<h3>{$concernsTitle}</h3>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:list -->\n<ul>\n";
    foreach ($concernsList as $item) {
        $html .= "<li>{$item}</li>\n";
    }
    $html .= "</ul>\n<!-- /wp:list -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2><strong>{$solutionsTitle} in {$locName}</strong></h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:list -->\n<ul>\n";
    foreach ($solutionsList as $item) {
        $html .= "<li>{$item}</li>\n";
    }
    $html .= "</ul>\n<!-- /wp:list -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2><strong>How {$service_title} Protects &amp; Enhances Your Property</strong></h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:paragraph -->\n";
    $html .= "<p>{$eeatText}</p>\n";
    $html .= "<!-- /wp:paragraph -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2><strong>{$service_title} Cost Expectations in {$locName}</strong></h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:paragraph -->\n";
    $html .= "<p>{$costText}</p>\n";
    $html .= "<!-- /wp:paragraph -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2><strong>Our Systematic Restoration Process</strong></h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    $html .= "<!-- wp:list {\"ordered\":true} -->\n<ol>\n";
    foreach ($processSteps as $step) {
        $html .= "<li>{$step}</li>\n";
    }
    $html .= "</ol>\n<!-- /wp:list -->\n\n";

    $html .= "<!-- wp:heading -->\n";
    $html .= "<h2>Frequently Asked Questions</h2>\n";
    $html .= "<!-- /wp:heading -->\n\n";

    foreach ($faqs as $faq) {
        $html .= "<p><strong>Q: {$faq['q']}</strong><br/>A: {$faq['a']}</p>\n";
    }
    $html .= "\n";

    // Build JSON-LD Schema
    $schemaFaqs = [];
    foreach ($faqs as $faq) {
        $schemaFaqs[] = [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq['a']
            ]
        ];
    }
    $schemaJson = json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $schemaFaqs
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

    $html .= "<script type=\"application/ld+json\">\n{$schemaJson}\n</script>";

    return $html;
}
