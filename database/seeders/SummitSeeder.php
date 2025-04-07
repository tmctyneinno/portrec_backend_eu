<?php

namespace Database\Seeders;

use App\Models\Summit;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SummitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [

           [
            'title' => 'GLOBAL WORKFORCE INTEGRITY: Innovation Technology, Compliance, and Trust in Recruitment & Cross-Border Engagement', 
           'link' => 'https://events.teams.microsoft.com/event/a9a41914-40b5-4070-91bd-4f1bdfa319ab@252fbfd9-7d72-47b6-bc0d-43af771c9b6e',
            'summit_date' => Carbon::now()->addDays(52),
            'content' => 'We shall be dissecting and analysing a crucial topic in the recruitment sector. The theme for this highly anticipated event is:
                    “GLOBAL WORKFORCE INTEGRITY: Innovation Technology, Compliance, and Trust in Recruitment & Cross-Border Engagement”

                    Are you ready to take the HR world by storm? The time has come to amplify your skills, ignite your career, and revolutionize HR management in Africa and across the globe!

                    Join us for an electrifying FREE webinar to reshape your understanding of HR’s pivotal role in Global Workforce integrity

                    Uncover cutting-edge strategies, practical insights, and proven techniques to navigate the ever-evolving HR landscape. Be prepared to elevate your expertise and make an impact that will reverberate across organizations and industries!

                    Then join us to spread the word by tagging your HR colleagues, and sharing this announcement.

                    Date: Friday, 28th of February, 2025
                    ⏰: 12pm
                    📍: Microsoft Teams', 
            'is_active' => '2', 
            'image' => 'https://media.licdn.com/dms/image/v2/D4D22AQGPM5FmrYR4Nw/feedshare-shrink_2048_1536/B4DZUToKgrHYAs-/0/1739791052593?e=1746662400&v=beta&t=9ogynCO84G20zlSS3nv39k76vraA1bQBFpsY6lNkUXQ',
            'venue' => 'Microsoft Teams'
        ], 

        [
            'title' => 'GLOBAL WORKFORCE INTEGRITY: Innovation Technology, Compliance, and Trust in Recruitment & Cross-Border Engagement', 
           'link' => 'https://events.teams.microsoft.com/event/a9a41914-40b5-4070-91bd-4f1bdfa319ab@252fbfd9-7d72-47b6-bc0d-43af771c9b6e',
            'summit_date' => '',
            'content' => 'We shall be dissecting and analysing a crucial topic in the recruitment sector. The theme for this highly anticipated event is:
                    “GLOBAL WORKFORCE INTEGRITY: Innovation Technology, Compliance, and Trust in Recruitment & Cross-Border Engagement”

                    Are you ready to take the HR world by storm? The time has come to amplify your skills, ignite your career, and revolutionize HR management in Africa and across the globe!

                    Join us for an electrifying FREE webinar to reshape your understanding of HR’s pivotal role in Global Workforce integrity

                    Uncover cutting-edge strategies, practical insights, and proven techniques to navigate the ever-evolving HR landscape. Be prepared to elevate your expertise and make an impact that will reverberate across organizations and industries!

                    Then join us to spread the word by tagging your HR colleagues, and sharing this announcement.

                    Date: Friday, 28th of February, 2025
                    ⏰: 12pm
                    📍: Microsoft Teams', 
            'is_active' => '2', 
            'image' => 'https://media.licdn.com/dms/image/v2/D4D22AQGPM5FmrYR4Nw/feedshare-shrink_2048_1536/B4DZUToKgrHYAs-/0/1739791052593?e=1746662400&v=beta&t=9ogynCO84G20zlSS3nv39k76vraA1bQBFpsY6lNkUXQ',
            'venue' => 'Microsoft Teams'
        ], 
        ];

        foreach($data as $dd) Summit::create($dd);
    }
}
