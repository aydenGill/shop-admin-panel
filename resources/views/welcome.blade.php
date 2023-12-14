<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soheil Khaledabadi - GitHub Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        header {
            background-color: #00f1ff;
            color: white;
            padding: 40px 20px;
            text-align: center;
        }

        section {
            padding: 40px 20px;
            margin: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .projects {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .project-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            max-width: 100%;
            transition: transform 0.3s ease-in-out;
        }

        .project-card:hover {
            transform: translateY(-5px);
        }

        .project-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .project-card .project-info {
            padding: 20px;
        }

        .project-card h3 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <header>
        <h1>Welcome to my GitHub profile!</h1>
        <p>I'm Soheil Khaledabadi, a passionate backend developer proficient in creating efficient and scalable solutions for web applications. With a focus on clean code and best practices, I strive to deliver high-quality software that meets the needs of end-users 🍀</p>
        <a href="https://github.com/soheilkhaledabdi" class="btn btn-light">Click here to my GitHub page</a>
    </header>

    <section class="container my-5">
        <h2>Socials:</h2>
        <div class="row">
            <div class="col-md-4">
                <a href="https://instagram.com/soheil_khaledabadi" class="btn btn-primary mb-3">Instagram</a>
            </div>
            <div class="col-md-4">
                <a href="https://linkedin.com/in/soheil-khaledabadi-17821621b" class="btn btn-primary mb-3">LinkedIn</a>
            </div>
            <div class="col-md-4">
                <a href="https://stackoverflow.com/users/18247370" class="btn btn-primary mb-3">Stack Overflow</a>
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2>Tech Stack:</h2>
        <div class="row">
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/go-%2300ADD8.svg?style=for-the-badge&logo=go&logoColor=white" alt="Go" class="img-fluid">
            </div>
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white" alt="PHP" class="img-fluid">
            </div>
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" class="img-fluid">
            </div>
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/apache-%23D42029.svg?style=for-the-badge&logo=apache&logoColor=white" alt="Apache" class="img-fluid">
            </div>
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" class="img-fluid">
            </div>
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/postgres-%23316192.svg?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL" class="img-fluid">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-2">
                <img src="https://img.shields.io/badge/Postman-FF6C37?style=for-the-badge&logo=postman&logoColor=white" alt="Postman" class="img-fluid">
            </div>
        </div>
    </section>

    <section class="container my-5">
        <h2>Pinned Projects on GitHub:</h2>
        <div class="projects">
            <div class="project-card">
                <a href="https://github.com/soheilkhaledabdi/shop-admin-panel">
                    <div class="project-info">
                        <h3>Shop admin panel</h3>
                        <p>Effortlessly manage your online store with our Laravel admin panel seamlessly integrated with Livewire, delivering real-time shopping experiences</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
