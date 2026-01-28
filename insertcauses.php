<?php
include 'database.php';

try {
    // Check if causes already exist
    $check = $db->query("SELECT COUNT(*) as count FROM CAUSES");
    $row = $check->fetch(PDO::FETCH_ASSOC);
    if ($row['count'] > 0) {
        echo "Causes already exist.";
        exit;
    }
    
    $sql = "INSERT INTO CAUSES (id, title, goal_amount, raised_amount, image_path, description) 
            VALUES (:id, :title, :goal, :raised, :image, :description)";
            $stmt = $db->prepare($sql);
            
            // Prepare your cause data as PHP arrays, you can add all causes here
            $causes = [
                [
                    'id' => 1,
                    'title' => 'Education Support for Orphans in Malaysia',
                    'goal' => 200000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause1.jpg',
                    'description' => '<p>In Malaysia, many orphans grow up without the stability and support that most children take for granted.
                    While these children face emotional hardship from a young age, they also often struggle to access quality education. Without
                    financial support, they risk falling behind, missing school, or dropping out altogether.</p>
                    <p>This campaign was created to ensure that no orphan is left behind simply because they lack the resources to learn. Through your kind
                    contributions, we aim to provide orphans across Malaysia with the tools they need to pursue their education with dignity, hope, and
                    confidence. Every donation helps restore their right to dream and build a better future.</p>
    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support goes directly into a dedicated education fund for orphans, helping to cover essential needs such as school fees and exam
                    registration costs, uniforms, shoes, and school supplies, as well as books, stationery, and other learning materials. It also assists in
                    providing digital devices and internet access for online learning and transportation to school or tuition centers. We work closely with
                    verified orphanages, guardians, and local community partners to ensure that each ringgit is spent wisely and reaches the children who need
                    it most.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports orphaned children in Malaysia who have lost one or both parents and lack sufficient financial support. These children
                    may live in orphanages or under the care of extended family or guardians. They show great potential and eagerness to continue their
                    education but face economic barriers that could prevent them from doing so without help.</p>

                    <h3>Why This Cause Matters?</h3>
                    <p>Every child deserves the chance to learn, grow, and thrive. For orphans, education can be their only path to independence and a brighter
                    future. Your donation is more than financial help, it\'s a message of love, support, and belief in their potential. With your help, we can
                    empower these children to rise above their circumstances and pursue their dreams with confidence.</p>

                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on the progress of the fund and how it is growing over time.</p>

                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support education for orphans in Malaysia. Your kindness makes more than just a difference, it opens doors and
                    brings light to children who need it most. No matter the amount, your gift means the world to a child who dares to dream of a better
                    tomorrow.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us build a future full of opportunity.</em></p>'
                ],
                [
                    'id' => 2,
                    'title' => 'Hunger Relief in Malaysia',
                    'goal' => 200000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause2.jpg',
                    'description' => '<p>In Malaysia, many families in vulnerable communities struggle daily with food insecurity and hunger. For these
                    individuals, accessing enough nutritious meals is a constant challenge, impacting their health, well-being, and ability to thrive.
                    Hunger can affect anyone but hits hardest those who are already facing economic hardship.</p>
                    <p>This campaign was created to ensure that no one in Malaysia goes hungry simply because they lack the resources to put food on the table.
                    Through your generous contributions, we aim to provide immediate food relief and long-term support to vulnerable communities across the
                    country. Every donation helps restore hope and nourishes lives, giving families the strength to build a better future.</p>
            
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support goes directly into providing essential food aid such as nutritious meals, groceries, and emergency food packs to those in
                    need. It also helps fund community kitchens, food distribution programs, and nutrition education initiatives. We work closely with verified
                    local partners, food banks, and community groups to ensure that each ringgit is used effectively to reach those suffering from hunger.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports individuals and families in Malaysia who face food insecurity due to financial difficulties, unemployment, or other
                    hardships. We focus on vulnerable groups such as low-income households, children, the elderly, and marginalized communities who need
                    immediate access to nutritious food to survive and thrive.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>Everyone deserves access to sufficient, healthy food. Hunger not only affects physical health but also limits opportunities for
                    education, work, and personal growth. Your donation is more than just food, it\'s a lifeline that offers dignity, hope, and the chance for
                    a better tomorrow. With your help, we can alleviate hunger and empower communities to break the cycle of poverty.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how the fund is being used and the difference it is making in the
                    fight against hunger in Malaysia.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support hunger relief in Malaysia. Your kindness not only feeds families but also uplifts communities and
                    builds a future where no one has to face hunger alone. No matter the amount, your gift brings hope and nourishment to those who need it
                    most.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us build a future free from hunger.</em></p>'
                ],
                [
                    'id' => 3,
                    'title' => 'Medical Aid for the Needy in Malaysia',
                    'goal' => 450000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause3.jpg',
                    'description' => '<p>In Malaysia, many individuals and families face serious medical challenges without the means to afford proper
                    treatment. From chronic illnesses to emergency care, the cost of healthcare can be overwhelming for those already struggling
                    financially. Without timely medical support, their health and often their lives are at risk.</p>
                    <p>This campaign was created to ensure that no one is denied medical care simply because they cannot afford it. Through your generous
                    contributions, we aim to provide critical medical aid to the needy across Malaysia. Every donation helps offer comfort, healing, and a
                    chance at a healthier future.</p>
                    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support goes directly into a dedicated medical aid fund, helping to cover essential needs such as doctor consultations, hospital
                    stays, diagnostic tests, medication, surgeries, and medical equipment. It also supports transportation to healthcare facilities and
                    follow-up treatments. We work closely with verified healthcare providers, NGOs, and community networks to ensure every ringgit is used
                    effectively to assist those most in need.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports individuals in Malaysia who are facing financial hardship and cannot afford necessary medical treatment. This includes
                    low-income families, the elderly, patients with chronic or critical illnesses, and others in urgent need of healthcare services. Many of
                    them show strong determination to recover but lack the means to get the care they need.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>Access to healthcare is a basic human right, not a privilege. For those living in poverty, medical aid can mean the difference between
                    life and death, pain and comfort, despair and hope. Your donation is more than financial support, it is a lifeline, a gesture of compassion,
                    and a belief in everyone\'s right to health and dignity.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how the medical aid fund is being used and the impact it is making
                    on the lives of those receiving help.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support medical aid for the needy in Malaysia. Your generosity brings healing, relief, and renewed strength to
                    those facing difficult times. No matter the amount, your gift provides more than treatment, it restores hope where it\'s needed most.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us build a healthier, more caring 
                    future.</em></p>'
                ],
                [
                    'id' => 4,
                    'title' => 'Empowering B40 Communities in Malaysia',
                    'goal' => 400000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause4.jpg',
                    'description' => '<p>In Malaysia, many families from the B40, income group face daily struggles to meet basic needs like safe shelter
                    and proper clothing. Living in unsafe or overcrowded housing and lacking suitable clothes for school, work, or weather can severely
                    affect their quality of life and sense of dignity.</p>
                    <p>This campaign was created to help ease these burdens and uplift B40 communities across Malaysia. Through your generous support, we aim
                    to provide essential shelter assistance and clothing aid to those who need it most. Every donation brings warmth, comfort, and renewed
                    dignity to individuals and families working hard to rise above their circumstances.</p>
            
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support goes directly into providing shelter-related aid such as home repairs, temporary housing support, and safe living conditions.
                    It also helps supply clean, appropriate clothing for children, adults, and the elderly whether it\'s for school, daily life, or emergencies.
                    We work closely with verified local partners and community organizations to ensure each ringgit is used effectively to benefit the B40
                    families in need.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports Malaysian families from the B40 group who are living in poverty and lack adequate housing or proper clothing.
                    Many are single-parent households, senior citizens, or families with young children facing harsh living conditions. They have the will to
                    improve their lives, but lack the means to do so alone.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>Having a safe place to live and proper clothes to wear are basic human needs. Without them, individuals especially childrens struggle to
                    stay healthy, confident, and hopeful. Your donation is more than material support, it\'s a sign of care and belief in a more equitable future. Together, we can help B40 families live with dignity and rebuild their lives with pride.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how the fund is being used and the positive changes it brings to
                    B40 communities across Malaysia.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support shelter and clothing aid for B40 communities in Malaysia. Your generosity provides warmth, protection,
                    and hope to families facing hardship. No matter the amount, your gift helps create safer, more dignified living conditions for those who
                    need it most.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us build a stronger and more caring
                    Malaysia.</em></p>'
                ],
                [
                    'id' => 5,
                    'title' => 'Clean Water for Rural Communities in Malaysia',
                    'goal' => 180000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause5.jpg',
                    'description' => '<p>In rural parts of Malaysia, many communities still lack access to clean and safe water. Without proper water
                    sources, families are forced to rely on unsafe supplies for drinking, cooking, and cleaning-putting their health and well-being at
                    constant risk. Children are especially vulnerable to waterborne diseases and poor hygiene conditions.</p>
            
                    <p>This campaign was created to help provide clean, safe, and reliable water access to rural communities across Malaysia. With your
                    generous support, we aim to bring life-changing water solutions to those who need them most. Every donation helps improve health, dignity,
                    and daily living for families in underserved areas.</p>
                    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support goes directly into building and maintaining clean water systems such as gravity-fed water pipelines, wells, water tanks,
                    and filtration units. It also helps fund sanitation and hygiene education to ensure long-term impact. We work closely with local communities,
                    NGOs, and verified partners to make sure every ringgit is used effectively and reaches the areas with the greatest need.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports rural and remote communities in Malaysia that do not have consistent access to clean water. Many of these communities
                    rely on river water or rainwater collection, which may be unsafe or insufficient. Your contribution helps children, the elderly, and entire
                    families enjoy better health and improved living conditions through reliable water access.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>Clean water is a basic human right. It\'s essential not only for survival but also for health, education, and economic growth.
                    When clean water is accessible, children can attend school, families can stay healthy, and communities can thrive. Your donation is more
                    than water. It\'s hope, opportunity, and a step towards equality.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how the fund is being used and the progress made in delivering
                    clean water to rural communities in Malaysia.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for supporting clean water initiatives for rural communities in Malaysia. Your generosity brings life-changing impact, health,
                    and hope to families in need. No matter the amount, your gift helps build a future where clean water is no longer a privilege, but a
                    guarantee.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us create lasting change through clean
                    water access.</em></p>'
                ],
                [
                    'id' => 6,
                    'title' => 'Support for Women\'s Empowerment in Malaysia',
                    'goal' => 150000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause6.jpg',
                    'description' => '<p>Across Malaysia, many women, especially those from underprivileged backgrounds, face challenges that limit their
                    access to education, employment, and opportunities to lead. Some are single mothers, survivors of domestic violence, or women in
                    rural communities striving to support their families with limited resources.</p>
                    <p>This campaign was created to uplift and empower women throughout Malaysia by providing them with the support and resources they need to
                    grow and succeed. Your contribution helps open doors to education, self-reliance, and brighter futures for women who are ready to take
                    charge of their lives.</p>
                    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support contributes directly to initiatives that offer skills training, access to education, small business guidance, emotional
                    support, and safe spaces for women in need. It also supports learning programs on financial planning, digital knowledge, and leadership
                    development. We work with trusted local partners and women\'s groups to ensure every ringgit makes a meaningful impact.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports women across Malaysia who face financial hardship, social inequality, or personal struggles. This includes single
                    mothers, women affected by abuse or poverty, and those living in rural or underserved communities. Your support helps them regain their
                    confidence, build independence, and create new opportunities for themselves and their families.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>When women are given the chance to thrive, families and communities become stronger. Empowered women contribute to education,
                    economic growth, and positive social change. Your donation is more than just assistance. It is a message of belief, support, and solidarity
                    with women who are ready to move forward with strength and purpose.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how the fund is being used and the positive impact it brings to
                    women across Malaysia.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for supporting women\'s empowerment in Malaysia. Your kindness helps create safer environments, greater opportunities, and
                    hopeful futures for women who deserve the chance to thrive. No matter the amount, your gift brings real and lasting change.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for helping us uplift women and build a stronger,
                    more inclusive society.</em></p>'
                ],
                [
                    'id' => 7,
                    'title' => 'Relief for Refugee Families in Gaza',
                    'goal' => 500000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause7.jpg',
                    'description' => '<p>In Gaza, countless families have been displaced by ongoing conflict and instability. Many live in overcrowded
                    shelters or makeshift housing, struggling each day to access food, clean water, medical care, and basic necessities. Children are
                    especially affected, growing up in environments filled with uncertainty, fear, and loss.</p>
            
                    <p>This campaign was created to provide urgent relief and restore dignity to refugee families in Gaza. Through your generous support,
                    we aim to deliver essential aid that meets their most pressing needs while offering hope and comfort in the face of hardship. Every donation
                    is a step toward safety, healing, and resilience.</p>
                    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your support helps provide emergency relief such as food packs, clean drinking water, hygiene kits, temporary shelter materials,
                    clothing, and medical supplies. It also helps fund long term efforts like trauma support, educational materials for children, and community
                    rebuilding projects. We work closely with trusted humanitarian partners on the ground to ensure every ringgit is used responsibly and
                    reaches those who need it most.</p>
                    
                    <h3>Who We Help?</h3>
                    <p>This fund supports displaced and vulnerable refugee families in Gaza who have lost their homes, livelihoods, and access to essential
                    services due to ongoing conflict. Many are women, children, the elderly, and individuals with health conditions who cannot survive without
                    outside assistance. Your contribution offers them relief, protection, and a chance to rebuild their lives.</p>
                    
                    <h3>Why This Cause Matters?</h3>
                    <p>No one should have to live without safety, shelter, and basic human dignity. For families in Gaza, humanitarian aid is often the only
                    support they receive. Your donation is more than a lifeline. It is an act of compassion that brings strength, hope, and humanity to people
                    facing unimaginable hardship.</p>
                    
                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how your donation is used and the impact it creates for families
                    in Gaza.</p>
                    
                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support relief efforts for refugee families in Gaza. Your kindness provides more than just aid. It brings
                    comfort, hope, and the assurance that they are not forgotten. No matter the amount, your gift makes a lasting difference.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for standing with Gaza\'s families in their time of
                    need.</em></p>'
                ],
                [
                    'id' => 8,
                    'title' => 'Emergency Medical Aid for Gaza',
                    'goal' => 650000.00,
                    'raised' => 0.00,
                    'image' => 'images/cause8.jpg',
                    'description' => '<p>Gaza is a warzone where hospitals are under immense pressure, and medical care is dangerously limited. Ongoing
                    airstrikes and violence have devastated the region\'s healthcare system. With power outages, damaged facilities, and a severe
                    shortage of supplies, doctors and nurses are working around the clock in impossible conditions to save lives.</p>
                    <p>This campaign was created to deliver emergency medical aid to the people of Gaza who are suffering as a result of the war.
                    Your support helps provide urgent care to the injured, the sick, and the most vulnerable. Every donation gives hope and healing in the
                    midst of destruction.</p>
                    
                    <h3>How Your Donation Helps?</h3>
                    <p>Your contribution supports the delivery of critical medical supplies, including pain relief, surgical tools, wound dressings, oxygen
                    tanks, and hygiene essentials. It also funds mobile clinics, trauma care teams, and fuel for ambulances that navigate through rubble
                    and danger zones. We work closely with verified humanitarian partners on the ground to ensure every ringgit reaches those who need help
                    the most.</p>

                    <h3>Who We Help?</h3>
                    <p>This fund supports injured civilians, children, elderly individuals, patients with chronic illnesses, and exhausted healthcare workers
                    in Gaza. Many of them are trapped in areas under constant attack, without access to hospitals or medicine. Your help ensures they receive
                    care and comfort during their darkest hours.</p>

                    <h3>Why This Cause Matters?</h3>
                    <p>No one should be left without medical care in a warzone. The people of Gaza are in urgent need of support, and your donation is a
                    lifeline. It brings relief, restores dignity, and shows that even in conflict, compassion can reach those who are suffering.</p>

                    <h3>Stay Informed of Our Impact</h3>
                    <p>We are committed to transparency. You will receive regular updates on how your donation is being used and the lives it touches in Gaza.</p>

                    <h3>Thank You</h3>
                    <p>Thank you for choosing to support emergency medical aid for Gaza. Your kindness makes a real difference for families caught in the
                    crossfire. No matter the amount, your generosity helps save lives and bring healing where it is needed most.</p>
                    <p><em>Once you donate, you will also receive donor points as a token of appreciation for standing with Gaza during this
                    humanitarian crisis.</em></p>'
                ],
                // Add other causes similarly
            ];
            
            // Insert all causes one by one
            foreach ($causes as $cause) {
                $stmt->execute([
                ':id' => $cause['id'],
                ':title' => $cause['title'],
                ':goal' => $cause['goal'],
                ':raised' => $cause['raised'],
                ':image' => $cause['image'],
                ':description' => $cause['description'],
            ]);
        }
        echo "Causes inserted successfully!";
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
?>