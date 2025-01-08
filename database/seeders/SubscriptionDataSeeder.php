<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\Models\SubscriptionData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $data = [

            // users  - Free 
            ['subscription_id' => 1, 'information' => 'Apply to an unlimited number of jobs without any restrictions..'],
            ['subscription_id' => 1, 'information' => 'Priority listing of resumes or CVs to make them more visible to employers.'],
            ['subscription_id' => 1, 'information' => 'Ability to edit and update resumes with multimedia (e.g., portfolio, certifications).'],
            ['subscription_id' => 1, 'information' => 'Set up customized job alerts based on location, salary, job title, and other preferences.'],
            ['subscription_id' => 1, 'information' => 'Receive instant notifications when new jobs are posted that match your criteria.'],

            //premuim
            ['subscription_id' => 2, 'information' => 'Increased visibility to employers who pay for premium job listings and candidate searches.'],
            ['subscription_id' => 2, 'information' => 'Option to make your resume visible to specific employers or recruiters.'],
            ['subscription_id' => 2, 'information' => 'Track how many employers have viewed your resume and profile'],
            ['subscription_id' => 2, 'information' => 'Receive insights on how to improve your profile for better visibility.'],
            ['subscription_id' => 2, 'information' => 'Access to exclusive or early access job listings that are only available to paid subscribers.'],
            ['subscription_id' => 2, 'information' => 'Fast-tracked application review by employers or recruiters, with increased chances of getting noticed.'],
            ['subscription_id' => 2, 'information' => 'Access to resume writing and professional editing services for crafting high-quality, employer-ready resumes.'],



            //recruiter  - free
            ['subscription_id' => 3, 'information' => 'Post an unlimited number of job openings without restrictions'],
            ['subscription_id' => 3, 'information' => 'Customizable company profile with logos,social accounts and detailed descriptions'],
            ['subscription_id' => 3, 'information' => 'Sort resumes by experience, skills, education, location, and more'],
            ['subscription_id' => 3, 'information' => 'Setup Interview questions, view user results'],

          
            //recruiter premium
            ['subscription_id' => 4, 'information' => 'Access to advanced search filters to find candidates that meet specific criteria'],
            ['subscription_id' => 4, 'information' => 'Built-in ATS tools to help streamline hiring, such as managing applications, screening resumes, and tracking communication with candidates'],
            ['subscription_id' => 4, 'information' => 'Algorithms that automatically match candidates with job openings based on skills, qualifications, and experience'],
            ['subscription_id' => 4, 'information' => 'View full profiles, including work history, skill endorsements, and recommendations from other employers'],
            ['subscription_id' => 4, 'information' => 'Ability to  generate unlimited zoom video link for interviews'],
            ['subscription_id' => 4, 'information' => 'Algorithms that filters candidate that gave correct answers to interview questions'],
        ];

        foreach($data as $datas) SubscriptionData::create($datas);
    }
}
