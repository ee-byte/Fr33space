<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>FreeSpace</title>
    <style>
        body {
                background:black;
                color:lime;
                font-family:Times New Roman;
                width: 800px;
                margin: 0 auto;
                padding: 20px;
         }
        textarea {
                width: 100%;
                height: 300px;
                font-family: Times New Roman;
                background: black;
                color: lime;
                border: 1px solid lime;
                padding: 10px;
         }
        #preview {
                background: black;
                width: 100%;
                margin-top: 20px;
                padding: 20px
                min-height: 400px;
         }
        button {
                background: none;
                border: none;
                padding: 0;
                cursor: pointer;
        }
        button img {
                display: block;
        }
    </style>
</head>
<body>
 
    <?php
    session_start();
 
    // Set this per profile file
    $profile_owner = 'dawidg81';
 
    // Check if user is logged in and owns this profile
    if (!isset($_SESSION['user']) || $_SESSION['user'] !== $profile_owner) {
        echo '<h1>Access Denied</h1>';
        echo '<p>GET OUT!!!</p>';
        echo '<a href="/login.php">Login</a>';
        exit;
    }
    ?>

    <h1>Edit Your Profile</h1>
    <p>Make your own profile! Don't be shy, HTML is easy. Escpecially with that magic browser of yours ;)</p>
    <p>When you're done, just E-mail it to me at gelocran@gmail.com,
 and if you want to add a photo, simply add it to your message</p>
 
    <textarea id="editor" placeholder="Endless possibilities..."></textarea>
    <br><br>
 
    <button onclick="updatePreview()"><img src="/preview.png"></button>
    <button onclick="copyToClipboard()"><img src="/copy.png"></button>
 
    <h2>Preview:</h2>
    <iframe id="preview" srcdoc="" style="width: 100%; height: 600px; border: 1px solid lime;"></iframe>
 
    <script>
        // Load from localStorage on page load
        window.addEventListener('load', function() {
            const saved = localStorage.getItem('profileDraft');
            if (saved) {
                document.getElementById('editor').value = saved;
                updatePreview();
            }
        });
 
        // Auto-save to localStorage as they type
        document.getElementById('editor').addEventListener('input', function() {
            localStorage.setItem('profileDraft', this.value);
        });
 
        function updatePreview() {
            const html = document.getElementById('editor').value;
            document.getElementById('preview').srcdoc = html;
        }
 
        function copyToClipboard() {
            const html = document.getElementById('editor').value;
            navigator.clipboard.writeText(html).then(() => {
                alert('HTML copied! Please send to gelocran@gmail.com');
            });
        }
    </script>
</body>
</html>
