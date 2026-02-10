<?php

namespace App;

enum UserRole: String
{
    case SUPER_ADMIN = 'super_admin'; // developer / owner
    case TAKMIR_ADMIN = 'takmir_admin'; // pengurus inti, full akses
    case TAKMIR = 'takmir'; // pengurus biasa
    case VIEWER = 'viewer'; // hanya lihat (opsional)
}
