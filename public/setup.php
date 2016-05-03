<?php

require __DIR__.'/../vendor/autoload.php';

use Illuminate\Filesystem\Filesystem;

class Setup
{
    protected $files;
    protected $messages;

    public function __construct(Filesystem $files)
    {
        $this->files = $files;

        $this->makeMessage("Starting ...<br/><br/>");
        $this->validateComposer();
        $this->populateFolders();
        $this->populateFiles();
    }

    private function validateComposer()
    {
        if (!$this->files->isFile("../composer.json"))
        {
            $this->exitMessage("../composer.json does not exist. Follow the instructions in README.MD to setup the environment first.");
        }
        if (!$this->files->isDirectory("../vendor/laravel/laravel"))
        {
            $this->exitMessage("../vendor/laravel/laravel does not exist. Run composer update -o from the command line.");
        }
    }

    private function populateFolders()
    {
        if ($this->files->copyDirectory('../vendor/laravel/laravel/bootstrap','../bootstrap'))
        {
            $this->makeMessage("Copy of ../bootstrap succesfully completed ...");
        }
        if ($this->files->copyDirectory('../vendor/laravel/laravel/config','../config'))
        {
            $this->makeMessage("Copy of ../config succesfully completed ...");
        }
        if ($this->files->copyDirectory('../vendor/laravel/laravel/resources','../resources'))
        {
            $this->makeMessage("Copy of ../resources succesfully completed ...");
        }
        if ($this->files->copyDirectory('../vendor/laravel/laravel/storage','../storage'))
        {
            $this->makeMessage("Copy of ../storage succesfully completed ...");
        }
    }

    private function populateFiles()
    {
        $this->copyFileInDirectory('../app/Http', 'app/Http/routes.php');
        $this->copyFileInDirectory('../tests', 'tests/TestCase.php');

        $this->copyFile('public/.htaccess');
        $this->copyFile('public/index.php');
        $this->copyFile('public/robots.txt');
        $this->copyFile('public/web.config');
        $this->copyFile('.env.example','.env');

        $this->makeMessage("<strong>*** Remember to update the ../.env file with the correct credentials ***</strong>");
    }

    private function copyFileInDirectory($directory, $source, $target = null)
    {
        if (!$this->files->isDirectory($directory))
        {
            if ($this->files->makeDirectory($directory, 0755, true))
            {
                $this->makeMessage("Create of ${directory} succesfully completed ...");
            }
        }
        $this->copyFile($source, $target);
    }

    private function copyFile($source, $target = null)
    {
        if ($target === null) {
            $target = $source;
        }

        if ($this->files->copy("../vendor/laravel/laravel/${source}","../${target}"))
        {
            $this->makeMessage("Copy of ../${target} succesfully completed ...");
        }
    }

    private function makeMessage($message)
    {
        $this->messages[] = array('message' => $message);
    }

    private function exitMessage($message)
    {
        $this->makeMessage($message);
        exit();
    }

    private function provideFeedback()
    {

        echo "<table>";
        echo "<tr><th>Message</th></tr>";
        foreach ($this->messages as $key => $value) {
            echo "<tr><td>{$value['message']}</td></tr>";
        }
        echo "</table>";

        echo "<br/>Setup Complete !!";
    }

   function __destruct() {
        $this->provideFeedback();
   }

}

$setup = new Setup(new Filesystem());
