<?php
$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$routes = [
    "/"                        => "controllers/index.php",
    "/login"                   => "controllers/auth/login.php",
    "/logout"                  => "controllers/auth/logout.php",
    "/register"                => "controllers/auth/register.php",
    "/profile/faculty-complete" => "controllers/profile/complete.php",
    "/profile/student-complete" => "controllers/profile/student-complete.php",
    "/admin/users"             => "controllers/admin/users.php",
    "/admin/users/action"      => "controllers/admin/user-action.php",

    "/admin/schedules"         => "controllers/admin/schedule/index.php",
    "/admin/schedule/create"   => "controllers/admin/schedule/create.php",
    "/admin/schedule/edit"     => "controllers/admin/schedule/edit.php",
    "/admin/schedule/delete"   => "controllers/admin/schedule/delete.php",

    "/faculty"                  => "controllers/faculty/index.php",
    // "/faculty/create"           => "controllers/faculty/create.php",
    "/faculty/edit"             => "controllers/faculty/edit.php",
    "/faculty/delete"           => "controllers/faculty/delete.php",

    // School Years
    "/admin/school-years"          => "controllers/admin/school-year/index.php",
    "/admin/school-year/create"    => "controllers/admin/school-year/create.php",
    "/admin/school-year/edit"      => "controllers/admin/school-year/edit.php",
    "/admin/school-year/delete"    => "controllers/admin/school-year/delete.php",

    // Semesters
    "/admin/semesters"             => "controllers/admin/semester/index.php",
    "/admin/semester/create"       => "controllers/admin/semester/create.php",
    "/admin/semester/edit"         => "controllers/admin/semester/edit.php",
    "/admin/semester/delete"       => "controllers/admin/semester/delete.php",

    "/admin/semesters"            => "controllers/admin/semester/index.php",
    "/admin/semester/create"      => "controllers/admin/semester/create.php",
    "/admin/semester/edit"        => "controllers/admin/semester/edit.php",
    "/admin/semester/delete"      => "controllers/admin/semester/delete.php",

    // Rooms
    "/admin/rooms"         => "controllers/admin/room/index.php",
    "/admin/room/create"   => "controllers/admin/room/create.php",
    "/admin/room/edit"     => "controllers/admin/room/edit.php",
    "/admin/room/delete"   => "controllers/admin/room/delete.php",

    // Subjects
    "/admin/subjects"        => "controllers/admin/subject/index.php",
    "/admin/subject/create"  => "controllers/admin/subject/create.php",
    "/admin/subject/edit"    => "controllers/admin/subject/edit.php",
    "/admin/subject/delete"  => "controllers/admin/subject/delete.php",
    // Sections
    "/admin/sections"          => "controllers/admin/section/index.php",
    "/admin/section/create"    => "controllers/admin/section/create.php",
    "/admin/section/edit"      => "controllers/admin/section/edit.php",
    "/admin/section/delete"    => "controllers/admin/section/delete.php",

];

function routesToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        http_response_code(404);
        echo "404 Not Found";
    }
}

routesToController($uri, $routes);
