<?php
/**
 * Inside Strata — Test Data Seeder
 *
 * HOW TO USE:
 *   1. Set STRATA_SEED_ENABLED below to true
 *   2. Log in to WordPress admin
 *   3. Visit: http://inside-strata.local/wp-content/themes/inside-strata-theme/seed.php
 *   4. Set STRATA_SEED_ENABLED back to false when done
 */

// === TOGGLE THIS TO RUN THE SEEDER ===
define('STRATA_SEED_ENABLED', false);

if ( ! STRATA_SEED_ENABLED ) {
    die('Seeder is disabled. Set STRATA_SEED_ENABLED to true in seed.php to run it.');
}

// Bootstrap WordPress
require_once dirname(__FILE__) . '/../../../wp-load.php';
require_once ABSPATH . 'wp-admin/includes/admin.php';
require_once ABSPATH . 'wp-admin/includes/taxonomy.php';

// Only allow logged-in admins to run this
if ( ! is_user_logged_in() || ! current_user_can('manage_options') ) {
    wp_die('You must be logged in as an admin to run the seeder.');
}

echo '<pre style="font-family:monospace; max-width:800px; margin:40px auto; line-height:1.8;">';
echo "=== Inside Strata Seeder ===\n\n";

// --------------------------------------------------
// 1. CREATE CATEGORIES
// --------------------------------------------------
$categories = array(
    'Industry News'    => 'industry-news',
    'Technology'       => 'technology',
    'Property'         => 'property',
    'Finance'          => 'finance',
    'Leadership'       => 'leadership',
    'Regulation'       => 'regulation',
);

$cat_ids = array();
foreach ( $categories as $name => $slug ) {
    $existing = get_category_by_slug($slug);
    if ( $existing ) {
        $cat_ids[$slug] = $existing->term_id;
        echo "Category exists: {$name}\n";
    } else {
        $id = wp_create_category($name);
        if ( ! is_wp_error($id) ) {
            $cat_ids[$slug] = $id;
            echo "Created category: {$name}\n";
        }
    }
}

// --------------------------------------------------
// 2. PLACEHOLDER IMAGES (from picsum.photos — free, no API key)
// --------------------------------------------------
$image_urls = array(
    'https://picsum.photos/seed/strata1/1200/600',
    'https://picsum.photos/seed/strata2/1200/600',
    'https://picsum.photos/seed/strata3/1200/600',
    'https://picsum.photos/seed/strata4/1200/600',
    'https://picsum.photos/seed/strata5/1200/600',
    'https://picsum.photos/seed/strata6/1200/600',
    'https://picsum.photos/seed/strata7/1200/600',
    'https://picsum.photos/seed/strata8/1200/600',
    'https://picsum.photos/seed/strata9/1200/600',
    'https://picsum.photos/seed/strata10/1200/600',
    'https://picsum.photos/seed/strata11/1200/600',
    'https://picsum.photos/seed/strata12/1200/600',
    'https://picsum.photos/seed/strata13/1200/600',
    'https://picsum.photos/seed/strata14/1200/600',
    'https://picsum.photos/seed/strata15/1200/600',
);

/**
 * Download an image from a URL and attach it to a post.
 */
function strata_sideload_image($url, $post_id, $desc) {
    require_once ABSPATH . 'wp-admin/includes/media.php';
    require_once ABSPATH . 'wp-admin/includes/file.php';
    require_once ABSPATH . 'wp-admin/includes/image.php';

    $tmp = download_url($url, 30);
    if ( is_wp_error($tmp) ) {
        return false;
    }

    $file_array = array(
        'name'     => sanitize_file_name($desc) . '.jpg',
        'tmp_name' => $tmp,
    );

    $thumb_id = media_handle_sideload($file_array, $post_id, $desc);
    if ( is_wp_error($thumb_id) ) {
        @unlink($file_array['tmp_name']);
        return false;
    }

    return $thumb_id;
}

// --------------------------------------------------
// 3. SAMPLE ARTICLES
// --------------------------------------------------
$articles = array(
    array(
        'title'    => 'Strata Reform Bill Passes Second Reading in Parliament',
        'category' => 'industry-news',
        'content'  => '<p>In a landmark decision, the federal government has passed the second reading of the Strata Reform Bill, signalling major changes for property owners and body corporate managers across the country.</p><p>The reforms aim to modernise governance structures, improve transparency in financial reporting, and give owners greater say in major building decisions. Industry groups have broadly welcomed the changes, though some have raised concerns about implementation timelines.</p><p>"This is a significant step forward for the millions of Australians living in strata-titled properties," said the Minister for Housing. "These reforms will bring our strata laws into the 21st century."</p><p>Key provisions include mandatory building defect bonds for new developments, enhanced dispute resolution pathways, and digital voting for owner meetings. The bill is expected to pass the Senate before the end of the current session.</p>',
        'excerpt'  => 'The federal government has passed the second reading of the Strata Reform Bill, signalling major changes for property owners and body corporate managers nationwide.',
    ),
    array(
        'title'    => 'How AI Is Transforming Building Management in 2026',
        'category' => 'technology',
        'content'  => '<p>Artificial intelligence is rapidly reshaping how residential and commercial buildings are managed. From predictive maintenance to energy optimisation, AI-powered systems are delivering measurable returns for strata managers.</p><p>Smart building platforms now analyse data from thousands of sensors to predict equipment failures before they occur, reducing emergency repair costs by up to 40%. Energy management systems use machine learning to optimise heating, cooling, and lighting based on occupancy patterns.</p><p>Leading strata management firms report that AI adoption has improved operational efficiency by 25-30%, while reducing energy consumption across their portfolios. The technology is also being used for automated compliance monitoring and streamlined communication with residents.</p>',
        'excerpt'  => 'From predictive maintenance to energy optimisation, AI-powered building management systems are delivering measurable returns for strata managers.',
    ),
    array(
        'title'    => 'Apartment Values Surge in Inner-City Markets',
        'category' => 'property',
        'content'  => '<p>Inner-city apartment markets have experienced a significant resurgence, with median prices climbing 12% across capital cities in the first quarter of 2026. The recovery follows several years of subdued growth and is being driven by returning demand from owner-occupiers and investors alike.</p><p>Melbourne and Sydney have led the charge, with premium apartment stock in established suburbs seeing the strongest gains. Analysts attribute the recovery to improved rental yields, infrastructure investments, and shifting lifestyle preferences toward urban living.</p><p>"We are seeing demographics that previously favoured houses now choosing well-located apartments," noted a senior research analyst. "Quality, amenity, and connectivity are the key drivers."</p>',
        'excerpt'  => 'Inner-city apartment markets have surged with median prices climbing 12% across capital cities, driven by returning demand from owner-occupiers and investors.',
    ),
    array(
        'title'    => 'New Insurance Requirements for High-Rise Buildings Take Effect',
        'category' => 'regulation',
        'content'  => '<p>New mandatory insurance requirements for high-rise residential buildings have officially come into effect, requiring comprehensive coverage for buildings over six storeys. The regulations mandate minimum coverage levels for structural defects, common property damage, and liability claims.</p><p>Body corporate committees must now obtain independent insurance valuations every three years, and all policies must include provisions for temporary relocation of residents during major repair works. Insurers have responded with specialised strata products designed to meet the new requirements.</p><p>Industry bodies are offering free compliance workshops for strata managers and committee members throughout the quarter. The new rules apply to all existing buildings, not just new developments, with a 12-month transition period for older properties.</p>',
        'excerpt'  => 'Mandatory insurance requirements for high-rise buildings have taken effect, requiring comprehensive coverage and independent valuations every three years.',
    ),
    array(
        'title'    => 'Leadership in Strata: Why Committee Training Matters',
        'category' => 'leadership',
        'content'  => '<p>Effective governance is the cornerstone of well-run strata communities, yet most committee members receive little to no formal training. A new national survey reveals that buildings with trained committees report 60% fewer disputes and significantly higher resident satisfaction.</p><p>The survey, conducted across 2,000 strata schemes, found that trained committees made better financial decisions, maintained more transparent communication, and were more likely to plan proactively for major maintenance. However, only 15% of current committee members have participated in any form of governance training.</p><p>Several states are now considering mandatory training requirements for committee officeholders, following the successful model implemented in New South Wales. Industry training providers report a 200% increase in enrolments over the past year.</p>',
        'excerpt'  => 'A national survey reveals that buildings with trained strata committees report 60% fewer disputes and significantly higher resident satisfaction.',
    ),
    array(
        'title'    => 'Understanding Sinking Funds: A Guide for New Owners',
        'category' => 'finance',
        'content'  => '<p>For new strata property owners, understanding sinking funds — also known as capital works funds — is essential for protecting your investment. These funds are set aside for major repairs and replacements that every building will eventually need, from roof restoration to lift modernisation.</p><p>Experts recommend that sinking funds maintain at least 70% of the amount identified in the latest capital works plan. Buildings that fall below this threshold risk special levies — unexpected lump-sum payments that can place significant financial pressure on owners.</p><p>Key items typically covered by sinking funds include exterior painting, waterproofing, common area refurbishment, mechanical services upgrades, and structural repairs. Regular professional assessments ensure that contribution levels keep pace with the building aging process.</p>',
        'excerpt'  => 'Understanding sinking funds is essential for strata property owners. Experts recommend maintaining at least 70% of planned capital works requirements.',
    ),
    array(
        'title'    => 'Sustainability Upgrades Drive Long-Term Value in Strata',
        'category' => 'property',
        'content'  => '<p>Sustainability upgrades are increasingly recognised as value drivers in the strata sector. Buildings with solar installations, efficient HVAC systems, and strong energy ratings are commanding premium prices and attracting higher-quality tenants.</p><p>A comprehensive study of 500 strata buildings found that properties with a NABERS rating of 5 stars or above sold for an average of 8% more than comparable buildings without sustainability credentials. Energy cost savings of $800-$1,200 per unit annually further enhance the investment case.</p><p>Popular upgrades include rooftop solar with battery storage, LED lighting conversions, smart water management systems, and electric vehicle charging infrastructure. Government incentives and green financing products are making these upgrades increasingly accessible for body corporates of all sizes.</p>',
        'excerpt'  => 'Buildings with strong sustainability credentials command premium prices and attract higher-quality tenants, with 5-star rated properties selling for 8% more.',
    ),
    array(
        'title'    => 'Digital Voting Set to Revolutionise AGM Participation',
        'category' => 'technology',
        'content'  => '<p>Digital voting platforms are transforming annual general meetings in strata communities, with early adopters reporting participation rates three to four times higher than traditional in-person voting. The technology allows owners to review agendas, ask questions, and cast votes from anywhere in the world.</p><p>Several states have updated their strata legislation to formally recognise digital voting, providing legal certainty for body corporates that adopt the technology. Platforms now include identity verification, audit trails, and real-time result tallying.</p><p>"We went from 20% participation to over 75% at our last AGM," reported one building manager in Brisbane. "Owners who had never engaged before are now actively voting on every resolution."</p>',
        'excerpt'  => 'Digital voting platforms are transforming strata AGMs, with early adopters reporting participation rates three to four times higher than traditional voting.',
    ),
    array(
        'title'    => 'Defect Bonds: What Developers Need to Know Before 2027',
        'category' => 'regulation',
        'content'  => '<p>New defect bond requirements coming into force in 2027 will have significant implications for residential developers. The legislation requires developers to lodge bonds equal to 3% of the contract price for buildings over three storeys, held for a minimum of 10 years.</p><p>The bonds can only be released once an independent building inspector certifies that all defects identified within the bond period have been rectified. Developers who fail to lodge bonds will be unable to register new strata plans.</p><p>Industry groups are urging developers to factor bond costs into project feasibilities now, as the requirements will apply to all projects with construction certificates issued after 1 January 2027. Insurance-backed bond products are emerging as the preferred mechanism for compliance.</p>',
        'excerpt'  => 'New defect bond requirements coming in 2027 will require developers to lodge bonds equal to 3% of contract price for buildings over three storeys.',
    ),
    array(
        'title'    => 'The Rise of Build-to-Rent and Its Impact on Strata Living',
        'category' => 'industry-news',
        'content'  => '<p>The build-to-rent sector is emerging as a significant force in the Australian apartment market, with over $15 billion in projects currently in the pipeline. While these developments operate outside traditional strata frameworks, they are influencing resident expectations across the entire sector.</p><p>Build-to-rent communities typically offer premium amenities, professional on-site management, and flexible lease terms. This is raising the bar for adjacent strata buildings, which are now investing in improved common areas and service levels to remain competitive.</p><p>Industry observers note that the growth of build-to-rent is also creating new career pathways for strata professionals, with skills in community management and building operations being highly transferable between the two sectors.</p>',
        'excerpt'  => 'With $15 billion in projects in the pipeline, the build-to-rent sector is emerging as a significant force influencing resident expectations across strata.',
    ),
    array(
        'title'    => 'Managing Short-Term Rentals in Strata: Best Practice Guide',
        'category' => 'industry-news',
        'content'  => '<p>Short-term rental platforms continue to present governance challenges for strata communities. A new best practice guide published by the national strata association provides a framework for body corporates seeking to balance owner rights with community amenity.</p><p>The guide recommends that all strata schemes establish clear by-laws addressing noise, security access, waste management, and minimum stay periods. It also emphasises the importance of maintaining building insurance compliance, as some policies exclude or limit coverage for properties used as short-term rentals.</p><p>Data from the guide shows that buildings with well-crafted short-term rental by-laws experience 50% fewer complaints than those without specific provisions. Template by-laws are available for download from the association website.</p>',
        'excerpt'  => 'A new best practice guide provides a framework for strata communities managing short-term rentals, with template by-laws available for download.',
    ),
    array(
        'title'    => 'Interest Rate Impacts on Strata Levy Budgets',
        'category' => 'finance',
        'content'  => '<p>Rising interest rates are having a flow-on effect on strata levy budgets, with building maintenance costs, insurance premiums, and contractor rates all climbing. Body corporate treasurers are being advised to build larger contingency buffers into annual budgets to account for continued cost pressures.</p><p>A survey of strata managers found that average levy increases of 8-12% are being proposed for the 2026-27 financial year, well above the general inflation rate. The largest cost drivers are insurance premiums (up 15-20% in some markets) and trades labour costs.</p><p>Financial advisors recommend that committees review their investment strategies for reserve funds, as higher interest rates also present an opportunity to earn better returns on sinking fund balances held in term deposits.</p>',
        'excerpt'  => 'Rising interest rates are driving strata levy increases of 8-12% for 2026-27, with insurance and labour costs identified as the largest cost drivers.',
    ),
    array(
        'title'    => 'EV Charging Infrastructure: A Practical Guide for Strata',
        'category' => 'technology',
        'content'  => '<p>As electric vehicle adoption accelerates, strata buildings face growing demand for charging infrastructure. Installing EV chargers in apartment buildings presents unique challenges around electrical capacity, cost allocation, and common property modifications.</p><p>The most successful implementations use a shared charging model with smart load management, which distributes available electrical capacity across multiple chargers dynamically. This approach avoids costly electrical upgrades while serving the maximum number of residents.</p><p>Body corporates considering EV charging should commission an electrical capacity assessment, establish a clear cost-sharing framework, and adopt by-laws that address installation standards, energy metering, and future expansion. Government grants covering up to 50% of installation costs are currently available in several states.</p>',
        'excerpt'  => 'Installing EV chargers in strata buildings presents unique challenges. Smart load management and government grants are making it increasingly feasible.',
    ),
    array(
        'title'    => 'Women in Strata Leadership: Breaking the Glass Ceiling',
        'category' => 'leadership',
        'content'  => '<p>Despite women making up nearly half of all strata property owners, they remain underrepresented in leadership positions within the industry. A new initiative launched by the Strata Community Association aims to address this imbalance through mentoring, networking, and professional development programs.</p><p>The program has already attracted over 300 participants nationwide, with mentees reporting increased confidence in pursuing senior roles. Several major strata management firms have signed diversity pledges committing to gender-balanced leadership teams by 2028.</p><p>"Diverse leadership teams make better decisions," said the program director. "Our industry manages assets worth hundreds of billions of dollars — we need the best talent, and that means ensuring equal opportunity for everyone."</p>',
        'excerpt'  => 'A new initiative aims to address gender imbalance in strata leadership, with over 300 participants and major firms signing diversity pledges.',
    ),
    array(
        'title'    => 'Fire Safety Compliance: What Your Building Must Do by December',
        'category' => 'regulation',
        'content'  => '<p>Updated fire safety compliance requirements take effect in December, bringing stricter standards for cladding remediation, fire door maintenance, and emergency evacuation planning. All residential buildings over three storeys must complete a comprehensive fire safety assessment by the deadline.</p><p>Buildings found to have non-compliant cladding must submit remediation plans within 60 days of assessment completion. The government has established a $500 million fund to assist body corporates with remediation costs for buildings where the original developer cannot be held liable.</p><p>Strata managers are encouraged to engage accredited fire safety practitioners as early as possible, given the expected surge in demand as the deadline approaches. Non-compliance penalties start at $50,000 for body corporates and $10,000 for individual committee members.</p>',
        'excerpt'  => 'Updated fire safety requirements take effect in December with stricter cladding, fire door, and evacuation standards for buildings over three storeys.',
    ),
);

echo "\n--- Creating posts ---\n\n";

$created_ids = array();
$cat_slugs   = array_values(array_keys($cat_ids));
$img_index   = 0;

foreach ( $articles as $index => $article ) {
    // Check if a post with this exact title already exists
    $existing = get_page_by_title($article['title'], OBJECT, 'post');
    if ( $existing ) {
        echo "Post exists: {$article['title']}\n";
        $created_ids[] = $existing->ID;
        continue;
    }

    // Stagger publish dates so posts have a clear order (newest first)
    $date = date('Y-m-d H:i:s', strtotime("-{$index} days"));

    $post_id = wp_insert_post(array(
        'post_title'   => sanitize_text_field($article['title']),
        'post_content' => wp_kses_post($article['content']),
        'post_excerpt' => sanitize_text_field($article['excerpt']),
        'post_status'  => 'publish',
        'post_author'  => get_current_user_id(),
        'post_date'    => $date,
        'post_category' => isset($cat_ids[$article['category']])
            ? array($cat_ids[$article['category']])
            : array(),
    ));

    if ( is_wp_error($post_id) ) {
        echo "FAILED: {$article['title']} — " . $post_id->get_error_message() . "\n";
        continue;
    }

    $created_ids[] = $post_id;

    // Attach a featured image
    $img_url = $image_urls[$img_index % count($image_urls)];
    $img_index++;

    echo "Downloading image for: {$article['title']}...\n";
    $thumb_id = strata_sideload_image($img_url, $post_id, sanitize_title($article['title']));
    if ( $thumb_id ) {
        set_post_thumbnail($post_id, $thumb_id);
        echo "Created: {$article['title']} (ID {$post_id}, image attached)\n";
    } else {
        echo "Created: {$article['title']} (ID {$post_id}, image failed — post still created)\n";
    }
}

// --------------------------------------------------
// 4. CREATE A PRIMARY NAVIGATION MENU
// --------------------------------------------------
echo "\n--- Setting up navigation menu ---\n\n";

$menu_name = 'Primary Menu';
$menu_exists = wp_get_nav_menu_object($menu_name);

if ( ! $menu_exists ) {
    $menu_id = wp_create_nav_menu($menu_name);

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title'  => 'Home',
        'menu-item-url'    => home_url('/'),
        'menu-item-status' => 'publish',
        'menu-item-type'   => 'custom',
    ));

    foreach ( $categories as $name => $slug ) {
        $cat = get_category_by_slug($slug);
        if ( $cat ) {
            wp_update_nav_menu_item($menu_id, 0, array(
                'menu-item-title'     => $name,
                'menu-item-object'    => 'category',
                'menu-item-object-id' => $cat->term_id,
                'menu-item-type'      => 'taxonomy',
                'menu-item-status'    => 'publish',
            ));
        }
    }

    // Assign to theme location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['primary'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);

    echo "Created and assigned menu: {$menu_name}\n";
} else {
    echo "Menu already exists: {$menu_name}\n";
}

// --------------------------------------------------
// 5. SET HOMEPAGE TO SHOW LATEST POSTS
// --------------------------------------------------
update_option('show_on_front', 'posts');
echo "\nHomepage set to show latest posts.\n";

echo "\n=== Done! ===\n";
echo "Created " . count($created_ids) . " posts across " . count($cat_ids) . " categories.\n";
echo "Visit your site: " . home_url('/') . "\n";
echo "\n⚠ DELETE THIS FILE NOW: seed.php\n";
echo '</pre>';
