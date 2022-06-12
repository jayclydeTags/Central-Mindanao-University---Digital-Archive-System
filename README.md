## Anonymous

<h3>CMU - DIGITAL ARCHIVE SYSTEM</h3>

<p>The Digital Archive System is an online tool that is part of CMU Records Management Unit, this is developed to improve the RMU in providing services to its constituents. This serves as the gateway for students, faculties and alumnus to access important records or material to improve materials supporting their learning and providing unique materials for quality education.</p>


<h5>Installation</h5>
<ol>
    <li>composer update</li>
    <li>npm install</li>
    <li>npm run dev</li>
    <li>cp .env.example .env</li>
    <li>configure your database in .env</li>
    <li>php artisan key:generate</li>
    <li>php artisan migrate</li>
    <li>php artisan db:seed UserTableSeeder</li>
    <li>php artisan storage:link</li>
    <li>php artisan serve</li>
</ol>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>
