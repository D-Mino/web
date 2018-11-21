<?php

function error_msg($type = 'none')
{
    $_error = array();
    $_error["none"] = "There was an unidentified error, please try again.";

    // List error messages
    $_error["email"] = array(
        "dev" => "Email not found.",
        "ui" => "We could not find a user with that email address."
    );

    $_error["password"] = array(
        "dev" => "Password incorrect.",
        "ui" => "You have entered an incorrect password."
    );

    $_error["user"] = array(
        "dev" => "User not found.",
        "ui" => "We could not find a user with that ID."
    );

    $_error["id"] = array(
        "dev" => "No ID.",
        "ui" => "We could not find any ID."
    );

    $_error["data"] = [
        "dev" => "Bad request.",
        "ui" => "Not enough params. Please try again."
    ];

    // Return error messages
    if(!$_error[$type])
        return $_error["none"];

    return $_error[$type];
}
