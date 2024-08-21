<?php 
// Admin user variables
$admin_id = 0;
$user_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
$email_verified = 1;
$approved = 0;
// general variables
$errors = [];
$user_type = "";

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

function isAdmin()
{
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'Admin' ) {
                return true;
        }else{
                return false;
        }
}

function isAuthor()
{
        if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'Author' ) {
                return true;
        }else{
                return false;
        }
}

function getUsersOfType(){

    if (isset($_GET['type'])){
        $user_type = $_GET['type'];
        if ($user_type == "admin"){
            $users_of_type = GetAdminUsers();
            return $users_of_type;
        }
        if ($user_type == "nonadmin"){
            $users_of_type = GetNonAdminUsers();
            return $users_of_type;
        }
        if ($user_type == "pending"){
            $users_of_type = GetPendingUsers();
            return $users_of_type;
        }
    } else {
        global $conn;
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);
        $users_of_type = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $users_of_type;
    }
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
        global $conn, $roles;
        $sql = "SELECT * FROM users WHERE role='Admin' OR role='Author'";
        $result = mysqli_query($conn, $sql);
        $admin_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $admin_users;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all non-admin users
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getNonAdminUsers(){
        global $conn, $roles;
        $sql = "SELECT * FROM users WHERE role='Viewer' OR role='Commentor'";
        $result = mysqli_query($conn, $sql);
        $non_admin_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $non_admin_users;
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all pending users
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getPendingUsers(){
        global $conn, $roles;
        $sql = "SELECT * FROM users WHERE email_verified=0 OR approved=0";
        $result = mysqli_query($conn, $sql);
        $pending_users = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $pending_users;
}

/* - - - - - - - - - - 
-  Users actions
- - - - - - - - - - -*/

// if user clicks the approve user button
if (isset($_GET['approve']) || isset($_GET['unapprove'])) {
    $message = '';
    if (isset($_GET['approve'])) {
        $message = "User approved successfully";
        $user_id = $_GET['approve'];
    } else if (isset($_GET['unapprove'])) {
        $message = "User successfully unapproved";
        $user_id = $_GET['unapprove'];
    }
    toggleApproveUser($user_id, $message);
}

// toggle if user is approved
function toggleApproveUser($user_id, $message)
{
        global $conn;
        $sql = "UPDATE users SET approved=ABS(approved-1) WHERE id=$user_id"; 
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message'] = $message;
            header("location: users.php");
            exit(0);
        }
}

// if user clicks the create user button
if (isset($_POST['create_user'])) {
        createUser($_POST);
}
// if user clicks the Edit user button
if (isset($_GET['edit-user'])) {
        $isEditingUser = true;
        $user_id = $_GET['edit-user'];
        editUser($user_id);
}
// if user clicks the update user button
if (isset($_POST['update_user'])) {
        updateUser($_POST);
}
// if user clicks the Delete user button
if (isset($_GET['delete-user'])) {
        $user_id = $_GET['delete-user'];
        deleteUser($user_id);
}


/* - - - - - - - - - - - -
-  Non-admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new non-admin data from form
* - Create new non-admin user
* - Returns all non-admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createUser($request_values){
        global $conn, $errors, $role, $username, $email, $email_verified, $approved;
        $username = esc($request_values['username']);
        $email = esc($request_values['email']);
        $password = esc($request_values['password']);
        $passwordConfirmation = esc($request_values['passwordConfirmation']);

        if(isset($request_values['role'])){
                $role = esc($request_values['role']);
        }
        if (isset($request_values['email_verified'])) {
            $email_verified = esc($request_values['email_verified']);
        }
        if (isset($request_values['approved'])) {
            $approved = esc($request_values['approved']);
        }
        // form validation: ensure that the form is correctly filled
        if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
        if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
        if (empty($role)) { array_push($errors, "Role is required for non-admin users");}
        if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
        if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
        // Ensure that no user is registered twice. 
        // the email and usernames should be unique
        $user_check_query = "SELECT * FROM users WHERE username='$username' 
                                                        OR email='$email' LIMIT 1";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        if ($user) { // if user exists
                if ($user['username'] === $username) {
                  array_push($errors, "Username already exists");
                }

                if ($user['email'] === $email) {
                  array_push($errors, "Email already exists");
                }
        }
        // register user if there are no errors in the form
        if (count($errors) == 0) {
                $password = md5($password);//encrypt the password before saving in the database
                $query = "INSERT INTO users (username, email, role, password, email_verified, approved, created_at, updated_at) 
                                  VALUES('$username', '$email', '$role', '$password', '$email_verified', '$approved', now(), now())";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "User created successfully";
                header('location: users.php');
                exit(0);
        }
}

/* * * * * * * * * * * * * * * * * * * * *
* - Takes non-admin id as parameter
* - Fetches the non-admin from database
* - sets non-admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editUser($user_id)
{
        global $conn, $username, $role, $isEditingUser, $user_id, $email, $email_verified, $approved;

        $sql = "SELECT * FROM users WHERE id=$user_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_assoc($result);

        // set form values ($username and $email) on the form to be updated
        $username = $user['username'];
        $email = $user['email'];
        $role = $user['role'];
        $email_verified = $user['email_verified'];
        $approved = $user['approved'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateUser($request_values){
    global $conn, $errors, $role, $username, $isEditingUser, $user_id, $email, $email_verified, $approved;
    // get id of the non-admin to be updated
    $user_id = $request_values['user_id'];
    // set edit state to false
    $isEditingUser = false;


    $username = esc($request_values['username']);
    $email = esc($request_values['email']);
    $password = esc($request_values['password']);
    $passwordConfirmation = esc($request_values['passwordConfirmation']);

    // get info about post from database
    $sql = "SELECT * FROM users WHERE id=$user_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    $role = $user['role'];
    $email_verified = $user['email_verified'];
    $approved = $user['approved'];
    
    if(isset($request_values['role'])){
            $role = $request_values['role'];
    }
    if (isset($request_values['email_verified'])) {
        $email_verified = esc($request_values['email_verified']);
    }
    if (isset($request_values['approved'])) {
        $approved = esc($request_values['approved']);
    }

    // register user if there are no errors in the form
    if (count($errors) == 0) {
            //encrypt the password (security purposes)
            $password = md5($password);

            $query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password', email_verified='$email_verified', approved='$approved' WHERE id=$user_id";
            mysqli_query($conn, $query);

            $_SESSION['message'] = "User updated successfully";
            header('location: users.php');
            exit(0);
    }
}
// delete non-admin user 
function deleteUser($user_id) {
        global $conn;
        $sql = "DELETE FROM users WHERE id=$user_id";
        if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "User successfully deleted";
                header("location: users.php");
                exit(0);
        }
}

/* - - - - - - - - - - 
-  Topic actions
- - - - - - - - - - -*/
// if user clicks the create topic button
if (isset($_POST['create_topic'])) { createTopic($_POST); }
// if user clicks the Edit topic button
if (isset($_GET['edit-topic'])) {
        $isEditingTopic = true;
        $topic_id = $_GET['edit-topic'];
        editTopic($topic_id);
}
// if user clicks the update topic button
if (isset($_POST['update_topic'])) {
        updateTopic($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-topic'])) {
        $topic_id = $_GET['delete-topic'];
        deleteTopic($topic_id);
}

/* - - - - - - - - - - 
-  Topics functions
- - - - - - - - - - -*/
// get all topics from DB
function getAllTopics() {
        global $conn;
        $sql = "SELECT * FROM topics";
        $result = mysqli_query($conn, $sql);
        $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $topics;
}
function createTopic($request_values){
        global $conn, $errors, $topic_name;
        $topic_name = esc($request_values['topic_name']);
        // create slug: if topic is "Life Advice", return "life-advice" as slug
        $topic_slug = makeSlug($topic_name);
        // validate form
        if (empty($topic_name)) { 
                array_push($errors, "Topic name required"); 
        }
        // Ensure that no topic is saved twice. 
        $topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
        $result = mysqli_query($conn, $topic_check_query);
        if (mysqli_num_rows($result) > 0) { // if topic exists
                array_push($errors, "Topic already exists");
        }
        // register topic if there are no errors in the form
        if (count($errors) == 0) {
                $query = "INSERT INTO topics (name, slug) 
                                  VALUES('$topic_name', '$topic_slug')";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Topic created successfully";
                header('location: topics.php');
                exit(0);
        }
}

/* * * * * * * * * * * * * * * * * * * * *
* - Takes topic id as parameter
* - Fetches the topic from database
* - sets topic fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
        global $conn, $topic_name, $isEditingTopic, $topic_id;
        $sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $topic = mysqli_fetch_assoc($result);
        // set form values ($topic_name) on the form to be updated
        $topic_name = $topic['name'];
}
function updateTopic($request_values) {
        global $conn, $errors, $topic_name, $topic_id;
        $topic_name = esc($request_values['topic_name']);
        $topic_id = esc($request_values['topic_id']);
        // create slug: if topic is "Life Advice", return "life-advice" as slug
        $topic_slug = makeSlug($topic_name);
        // validate form
        if (empty($topic_name)) { 
                array_push($errors, "Topic name required"); 
        }
        // register topic if there are no errors in the form
        if (count($errors) == 0) {
                $query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
                mysqli_query($conn, $query);

                $_SESSION['message'] = "Topic updated successfully";
                header('location: topics.php');
                exit(0);
        }
}
// delete topic 
function deleteTopic($topic_id) {
        global $conn;
        $sql = "DELETE FROM topics WHERE id=$topic_id";
        if (mysqli_query($conn, $sql)) {
                $_SESSION['message'] = "Topic successfully deleted";
                header("location: topics.php");
                exit(0);
        }
}


/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc($value){
        // bring the global db connect object into function
        global $conn;
        // remove empty space sorrounding string
        $val = trim($value); 
        $val = mysqli_real_escape_string($conn, $value);
        return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug($string){
        $string = strtolower($string);
        $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
        return $slug;
}
?>
