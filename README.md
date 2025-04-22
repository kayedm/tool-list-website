# Tool Tracking Website

A web-based application for managing and tracking tools with user profiles, theme switching, and robust validation.


## Features
- **Add/Edit/Delete Tools**: Manage tool inventory with forms.
- **User Profiles**: Each user has a profile with stats (Username, Amount of tools).
- **Frontend & Backend Validation**: Ensure all input data is valid and secure.
- **Light/Dark Theme Toggle**: User preference for interface theme.
- **Search Functionality**: Quickly search tools by name or description.

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
  
   ```sql

   CREATE TABLE users (
       id INT AUTO_INCREMENT PRIMARY KEY,
       username VARCHAR(50) NOT NULL UNIQUE,
       email VARCHAR(100) NOT NULL UNIQUE,
       password VARCHAR(255) NOT NULL
   );

   CREATE TABLE tools (
       id INT AUTO_INCREMENT PRIMARY KEY,
       name VARCHAR(255),
       ToolCondition VARCHAR(255),
       cost DECIMAL(10,2),
       user_id INT NOT NULL,
       FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
   );

5. **Configure the database connection**:
   - Open `credentials.php` in the project root.
   - Set your database credentials:
     ```php
      define("DB_SERVER", "localhost");
      define("DB_USER", "root");
      define("DB_PASS", ""); // your db password
      define("DB_NAME", ""); // your db name
     ```

6. **Access the website**:
   - Go to `http://localhost/tool-tracking-website` in your browser.


