<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = DB::table('companies')->pluck('id')->toArray();


        $projects = [
            [
                'title' => 'AI-Powered Resume Screening System',
                'description' => "This project focuses on building an AI-powered system for resume screening to assist HR departments in filtering job applicants efficiently.

                The system will leverage Natural Language Processing (NLP) to extract key information such as skills, experience, and education from resumes. Machine learning algorithms will be used to rank candidates based on predefined criteria.

                Additionally, the platform will feature an intuitive dashboard for recruiters to adjust filters, view applicant rankings, and export data. Integration with third-party HR systems via API will be included. The backend will be developed using Python and Django, while the frontend will be built with React.",
                'required_rank' => 1,
                'deadline' => now()->addDays(90),
                'reward_amount' => 400.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'E-Commerce Platform for Local Businesses',
                'description' => "A scalable and feature-rich e-commerce platform aimed at helping local businesses expand their online presence.

                The system will support multi-vendor functionality, allowing different businesses to register, manage their products, and process transactions. Features will include real-time inventory tracking, sales analytics, and seamless integration with payment gateways like Stripe and PayPal.

                Security is a priority, with end-to-end encryption and role-based access control. The platform will be developed using Laravel for the backend and Vue.js for the frontend.",
                'required_rank' => 1,
                'deadline' => now()->addDays(120),
                'reward_amount' => 300.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Custom CRM System for Sales Teams',
                'description' => "We need a custom CRM system designed specifically for sales teams to manage leads, contacts, and customer interactions efficiently.

                The system must include lead tracking, pipeline visualization, automated email follow-ups, and collaboration tools for sales teams. The CRM should also integrate with Google Calendar and Slack for seamless communication.

                The preferred tech stack includes Node.js for the backend and React for the frontend. The database should be optimized for handling large customer datasets using PostgreSQL.",
                'required_rank' => 2,
                'deadline' => now()->addDays(100),
                'reward_amount' => 600.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cloud-Based Inventory Management System',
                'description' => "A cloud-based inventory management system to help businesses efficiently track and manage stock levels across multiple locations.

                The platform should include barcode scanning, automated restocking alerts, and analytics dashboards to track sales trends. Integration with popular ERP systems will be a key feature.

                The backend will be developed using Go for scalability, while the frontend will be built with Svelte to provide a smooth user experience.",
                'required_rank' => 2,
                'deadline' => now()->addDays(130),
                'reward_amount' => 550.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'On-Demand Food Delivery App',
                'description' => "A mobile app designed to connect users with local restaurants for fast and convenient food delivery.

                Key features include real-time order tracking, restaurant management dashboards, and a recommendation system based on user preferences. Secure payment processing and multi-language support are also required.

                The backend will be built using Ruby on Rails, with a mobile-first frontend using React Native for both iOS and Android.",
                'required_rank' => 3,
                'deadline' => now()->addDays(80),
                'reward_amount' => 900.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Fitness Tracking Mobile App',
                'description' => "This project focuses on developing a mobile application that allows users to track their fitness activities, set personal goals, and monitor progress.

                The app should include integration with smartwatches and health-tracking devices to collect real-time data. Features such as workout recommendations, diet planning, and progress reports will also be included.

                The mobile frontend will be built using Flutter, while the backend will be powered by Node.js and PostgreSQL.",
                'required_rank' => 3,
                'deadline' => now()->addDays(90),
                'reward_amount' => 820.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Blockchain-Based Voting System',
                'description' => "A secure and transparent online voting system using blockchain technology.

                This system will ensure that votes cannot be altered or manipulated after being cast. Each vote will be recorded as a blockchain transaction, ensuring transparency and security. The platform must include voter authentication, real-time vote counting, and a public verification system.

                Ethereum smart contracts will be used for vote processing, while the frontend will be built using Vue.js.",
                'required_rank' => 4,
                'deadline' => now()->addDays(150),
                'reward_amount' => 1200.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Virtual Reality Real Estate Platform',
                'description' => "A web-based VR real estate platform that allows potential buyers to explore properties remotely in 3D.

                The system should support VR headset compatibility, interactive virtual tours, and property comparison tools. High-resolution images and 360-degree videos should be included.

                The backend will be developed with Django, while the frontend will utilize React and WebGL for VR rendering.",
                'required_rank' => 4,
                'deadline' => now()->addDays(180),
                'reward_amount' => 1500.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'AI Chatbot for Customer Support',
                'description' => "An AI-driven chatbot system designed to assist customers in resolving issues efficiently.

                The chatbot should support text and voice interactions, provide instant answers to common queries, and escalate complex issues to human agents. It should integrate with existing CRM systems.

                The backend AI processing will be done using Python and TensorFlow, while the frontend will be built with Next.js.",
                'required_rank' => 5,
                'deadline' => now()->addDays(110),
                'reward_amount' => 2000.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cybersecurity Threat Detection System',
                'description' => "A real-time threat detection system that identifies cybersecurity risks and prevents attacks.

                This system should include features such as intrusion detection, automated risk assessment, and incident response. It must analyze network traffic, identify anomalies, and take preventative measures in real-time.

                The backend will be developed using Rust for high-performance security processing, while the frontend will be built with Angular.",
                'required_rank' => 5,
                'deadline' => now()->addDays(160),
                'reward_amount' => 2500.00,
                'status' => 'open',
                'company_id' => $companies[array_rand($companies)],
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('projects')->insert($projects);
    }
}
