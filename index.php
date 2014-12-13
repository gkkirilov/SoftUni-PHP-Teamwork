<?php

echo strlen(password_hash("asdsad", PASSWORD_BCRYPT, ["cost" => 10]));
