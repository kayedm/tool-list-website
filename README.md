# Tool Tracking Website

A web-based application for managing and tracking tools with user profiles, theme switching, and robust validation.


## Features
- **Add/Edit/Delete Tools**: Easily manage tool inventory with forms.
- **User Profiles**: Each user has a profile with stats (e.g., tools added, last login).
- **Frontend & Backend Validation**: Ensure all input data is valid and secure.
- **Light/Dark Theme Toggle**: User preference for interface theme.
- **Search Functionality**: Quickly search tools by name or description.


## Tech Stack
- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL
- **Environment**: XAMPP (Apache, PHP, MySQL)


## Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/kayedm/tool-tracking-website.git
   cd tool-tracking-website
   ```

2. **Set up XAMPP**:
   - Download and install XAMPP from [https://www.apachefriends.org](https://www.apachefriends.org).
   - Start **Apache** and **MySQL** from the XAMPP Control Panel.

3. **Move the project**:
   - Copy or move the project folder into `C:\xampp\htdocs\`.

4. **Create the database**:
   - Open `http://localhost/phpmyadmin`.
   - Create a new database (e.g., `tool_tracking`).
   - Create the starter tables:
  
      ```php
     $host = 'localhost';
     $db = 'tool_tracking';  // or your chosen DB name
     $user = 'root';
     $pass = '';  // default XAMPP MySQL password
     ```

5. **Configure the database connection**:
   - Open `config.php` in the project root.
   - Set your database credentials:
     ```php
     $host = 'localhost';
     $db = 'tool_tracking';  // or your chosen DB name
     $user = 'root';
     $pass = '';  // default XAMPP MySQL password
     ```

6. **Access the website**:
   - Go to `http://localhost/tool-tracking-website` in your browser.


