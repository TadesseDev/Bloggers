<div class="registration">
    <form action="" method="POST">
        <p class="formTitle">registr and post, comment, request and more...</p>
        <label for="firstName">
            first name
        </label>
        <input type="text" id="firstName" name="firstName" placeholder="Author first name" required="true">
        <label for="lastName">
            last name
        </label>
        <input type="text" id="lastName" name="lastName" placeholder="Author last ame" required="true">
        <label for="email">
            author email
        </label>
        <input type="email" id="email" name="email" placeholder="author@domain.com">
        <label for="title">
            author title
        </label>
        <input type="text" id="title" name="title" placeholder="M'r, Engineer, DR, Pro...">
        <label for="expertie">
            author profession
        </label>
        <input type="text" id="experties" name="experties" placeholder=" your profession">
        <label for="password">
            password
        </label>
        <input type="password" id="password" name="password" placeholder="password" required="true">
        <input type="password" id="confirmationPassword" name="confirmationPassword" placeholder="confirmation Password" required="true">
        <button class="button darkBrown ColorOrange" type="submit" name="RegisterNewUser">Register</button>
        <button class="button darkBrown ColorOrange" type="reset" name="cancel">Reset</button>
        <a class="button darkBrown ColorOrange" onclick="window.location='index.php'">cancel</a>
        <span><?php echo $message ?></span>
    </form>
</div>