<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Enable/Disable Migrations
|--------------------------------------------------------------------------
|
| Migrations are disabled by default for security reasons.
| You should enable migrations whenever you intend to do a schema migration
| and disable it back when you're done.
|
*/
$config['migration_enabled'] = TRUE;

/*
|--------------------------------------------------------------------------
| Migration Type
|--------------------------------------------------------------------------
|
| Either 'sequential' or 'timestamp'.
|
| 'sequential' migrations are numbered 001, 002, etc.
| 'timestamp' migrations are numbered YYYYMMDDHHIISS.
|
*/
$config['migration_type'] = 'timestamp';

/*
|--------------------------------------------------------------------------
| Migrations table
|--------------------------------------------------------------------------
|
| This is the name of the table that will store the current migration version.
|
*/
$config['migration_table'] = 'migrations';

/*
|--------------------------------------------------------------------------
| Auto-discover migrations
|--------------------------------------------------------------------------
|
| If you have migrations in multiple directories, you can configure them
| here. The path should be relative to the application directory.
|
*/
$config['migration_path'] = APPPATH . 'migrations/';

/*
|--------------------------------------------------------------------------
| Migration Version
|--------------------------------------------------------------------------
|
| This is the version your application should be at.
| If you use 'timestamp' migrations, this should be the timestamp of the
| latest migration.
|
*/
$config['migration_version'] = '20251109150000';