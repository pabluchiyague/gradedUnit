ReadMe & Installation Guide
This document provides instructions for setting up and using the Sustainability App, including system requirements, installation steps, login details, and functionality overview.
System Requirements
- PHP 7.4 or later
- MySQL 5.7 or later
- Apache Server (via XAMPP, WAMP, or LAMP)
- A modern web browser (e.g., Chrome, Firefox, Edge)
Installation & Setup
1. Download and install XAMPP (https://www.apachefriends.org/index.html).
2. Place the entire Sustain Energy project folder in the 'htdocs' directory.
3. Start Apache and MySQL from the XAMPP control panel.
4. Open phpMyAdmin (http://localhost/phpmyadmin) and import the included database SQL file.
5. Update 'includes/db.php' with your database credentials if needed.
6. Visit the site by navigating to http://localhost/[your-folder]/index.php
Using the Application
• The home page (dashboard) is accessible by anyone.
• Users must register and log in to access tools like the Green Calculator, Awards, Membership and Profile.
• Admins have access to the admin panel to manage users and view transactions.
• The Green Calculator awards a score from 0–100 and creates a donation based on missing points.
• Membership costs £400/year and provides users with certification.
• All purchases are saved to the database and visible in the admin panel.
• Certificates and awards can be downloaded as printable proof.
Admin Instructions
• Admins can promote/demote users and delete accounts (except their own).
• Admins can create users manually via the admin panel.
• All transactions and award history are viewable and tied to the user.
• Admin access requires the 'role' column to be set to 'admin' in the users table.
Additional Notes
• The system uses PDO with prepared statements for secure database communication.
• Images (badges, banners) should be placed in the 'images/' directory.
• The interface is fully responsive using Bootstrap 5 CDN.
• The footer and navbar are reusable components loaded dynamically using PHP includes.
