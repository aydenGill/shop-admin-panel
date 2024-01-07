<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>soheil khaledabadi - Developer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Raleway:wght@100&family=Roboto+Mono:wght@100&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            font-family: 'Open Sans', sans-serif;
            font-family: 'Raleway', sans-serif;
            font-family: 'Roboto Mono', monospace;
        }

        header {
            padding: 1em 0;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav {
            margin-left: 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
        }

        .content-section {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }

        h1 {
            font-size: 36px;
            margin-top: 0;
            color: #333;
        }

        h2 {
            font-size: 24px;
            color: #333;
        }

        p {
            font-size: 18px;
            line-height: 1.6;
            color: #555;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        .articles-page {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            color: #333;
        }

        .article {
            margin-bottom: 20px;
        }

        #links {
            padding: 20px;
            margin-top: 20px;
        }

        #links h1 {
            font-size: 24px;
            color: #333;
        }

        #links ul {
            list-style: none;
            padding: 0;
        }

        #links li {
            margin-bottom: 10px;
        }

        #links a {
            text-decoration: none;
            color: #0073e6;
            /* Link color */
            font-weight: bold;
        }

        #links a:hover {
            color: #0055a5;
        }

        /* Hover color */

        footer {
            padding: 10px 0;
            text-align: center;
            color: #555;
        }


        @media screen and (max-width: 600px) {
            h1 {
                font-size: 28px;
            }

            h2 {
                font-size: 20px;
            }

            p {
                font-size: 16px;
            }
        }
    </style>

</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="#about">About Me</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#links">Links</a></li>
            </ul>
        </nav>
    </header>

    <section id="about" class="content-section">
        <h1>About Me 👨‍💻</h1>
        <p>
            Welcome to my personal website. I'm Soheil Khaledabadi, a passionate backend developer dedicated to crafting
            innovative software solutions. My objective is to transform ideas into reality and continually enhance my
            skills.
        </p>
    </section>

    <section id="skills" class="content-section">
        <h1>Skills</h1>
        <p>I'm a backend developer with expertise in the following areas:</p>
        <ul>
            <li>Backend Development (PHP, Laravel, GoLang , GIN)</li>
            <li>Database Management (SQL, Postgres, MySQL)</li>
            <li>Version Control (Git)</li>
            <li>Server Management</li>
            <li>Rest API</li>
        </ul>
    </section>




    <section id="experience" class="content-section">
        <h1>Experience</h1>
        <div class="experience-item">
            <h2>Backend Developer at Asrez</h2>
            <p>
                I have been working with Asrez for a year, dedicated to back-end development and contributing to several exciting projects.
            </p>
            <p>
                You can visit the Asrez website <a href="https://asrez.com" target="_blank" rel="noopener noreferrer">here</a>.
            </p>
        </div>

        <div class="experience-item">
            <h2>Backend Developer at Kashan Tejarat</h2>
            <p>
                During my time at Kashan Tejarat, I served as a Backend Developer, contributing to various projects. You
                can check out some of my work <a href="https://kashantejarat.ir">here</a>.
            </p>
        </div>
    </section>

    <section id="projects" class="content-section">
        <h1>Projects</h1>
        <div class="project-item">
            <h2>Shopping Admin Panel with Laravel & Livewire</h2>
            <p>
                This project involves creating a robust admin panel to manage an e-commerce platform.
                It utilizes Laravel for the backend structure and Livewire for dynamic frontend interactions.
                The panel also offers a comprehensive API for scalability and flexibility.
            </p>
            <p>GitHub URL: <a href="https://github.com/soheilkhaledabdi/shop-admin-panel">Shop Admin Panel</a></p>
        </div>
    </section>


    <section id="links" class="content-section">
        <h1>Links</h1>
        <ul>
            <li><a href="https://www.linkedin.com/">LinkedIn</a></li>
            <li><a href="https://github.com/soheilkhaledabdi/">GitHub</a></li>
            <li><a href="mailto: soheilkhaledabdi@gmail.com">Send Email</a></li>
        </ul>
    </section>



    <footer>
        <p>&copy; 2023 <a href="https://soheilkhaledabadi.ir">soheil khaledabadi</a></p>
    </footer>
</body>

</html>
