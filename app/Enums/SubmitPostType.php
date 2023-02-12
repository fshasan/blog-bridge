<?php

namespace App\Enums;

interface SubmitPostType
{
    const POST_NOW = "post";
    const POST_AT_A_DIFFERENT_TIME = "scheduledPost";
}