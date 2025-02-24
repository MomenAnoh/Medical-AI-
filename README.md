Medical AI Application

Overview

This is a medical mobile application designed to assist patients by providing AI-driven responses to their symptoms. The application allows patients to input their symptoms and upload x-rays, which can either be analyzed by the AI model or forwarded to doctors for professional consultation. Doctors can log in, view patient queries, and respond based on the provided symptoms and medical images.

Features

AI Symptom Analysis: Patients enter symptoms, and the AI model provides initial guidance.

Doctor Consultation: Patients can directly ask doctors about symptoms and x-ray results.

X-Ray Uploading: Patients can upload x-ray images for medical review.

Doctor Responses: Doctors receive patient queries and provide responses based on medical expertise.

User Authentication: Secure login system for patients and doctors.

Database Schema

The application database consists of the following key tables:

1. Users Table

Stores user details, including patients and doctors.

id (bigint) - Primary Key
FullName (varchar)
phone (varchar)
Nationality (varchar)
gender (varchar)
age (int)
email (varchar)
email_verified_at (timestamp)
password (varchar)
usertype (varchar) [‘patient’, ‘doctor’]
remember_token (varchar)
created_at (timestamp)
updated_at (timestamp)

2. Questions Table

Stores patient queries related to symptoms.

id (bigint) - Primary Key
patient_id (bigint) - Foreign Key (Users)
doctor_id (bigint) - Foreign Key (Users, Nullable)
question_text (text)
status (enum) ['pending', 'answered']
created_at (timestamp)
updated_at (timestamp)

3. Responses Table

Stores doctor responses to patient queries.

id (bigint) - Primary Key
question_id (bigint) - Foreign Key (Questions)
doctor_id (bigint) - Foreign Key (Users)
response_text (text)
created_at (timestamp)
updated_at (timestamp)

4. X-Rays Table

Stores uploaded x-ray images linked to user accounts.

id (bigint) - Primary Key
Name_of_XRay (varchar)
Description_of_XRay (varchar)
Result_of_XRay (varchar)
type_of_XRay (varchar)
image_of_XRay (varchar)
user_id (bigint) - Foreign Key (Users)
created_at (timestamp)
updated_at (timestamp)

5. Medical Histories Table

Stores past medical records of users.

id (bigint) - Primary Key
Name_of_Surgery (varchar)
Description_of_Surgery (varchar)
user_id (bigint) - Foreign Key (Users)
created_at (timestamp)
updated_at (timestamp)

Installation and Setup

Prerequisites

PHP 8+

Laravel 11

MySQL

Composer



Steps

Clone the repository:

git clone https://github.com/your-repo/medical-ai.git
cd medical-ai

Install dependencies:

composer install

Configure environment:

cp .env.example .env

Set database credentials in .env

Run database migrations and seeders:

php artisan migrate --seed

Start the development server:

php artisan serve

API Endpoints

Authentication

POST /api/register - Register a new user

POST /api/login - Authenticate user

Patient Features

POST /api/questions - Submit a question

GET /api/questions/{id} - View question details

POST /api/xrays - Upload an x-ray

Doctor Features

GET /api/questions/pending - View pending questions

POST /api/questions/{id}/response - Respond to a question

Contributors

Your Name - Momen Ahmed





