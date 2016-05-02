# Boilerplate Laravel 5 Template

## Installation

Clone this repo with minimal history into the new project folder:

```sh
git clone --depth 1 git@github.com:Ycore/ytemplate.git
```

This should populate the project folder with the pre-configured composer.json file and the public/setup.php file.

## Configuration

The boilerplate files provide a scaffold for building your own application.  You'll need to make a bunch of changes to the files provided to make it your own.

### Update composer.json

Edit `composer.json` to reflect your package information.  At a minimum, you will need to change the package name and autoload lines so that "vendor/package" reflects your new package's name and namespace.

```json
{
  "name": "vendor/package",
  "description": "",
  "autoload": {
    "psr-4": {
      "Vendor\\Package\\":  "src/"
    }
  }
  ...
}
```

### Launch Composer in terminal

Launch composer from the shell to update all dependencies

```sh
composer update -o
```

### Launch Setup in the browser

Launch the setup process from http://appname.app/setup.php. This will create and/or copy the respective folders and files for a basic application stub.

### Update configuration in .env file

Update the configuration options in the .env file

### Test

Launch http://appname.app from the browser. This should load the public/index.php script.

### Cleanup

When everything works, remove the public/setup.php file.


### Last Steps

Update the `LICENSE` file as required (make sure it matches what you said your package's license is in `composer.json`).

Finally, update this `README.md` file with an appropriate description.

Commit everything to a (newly initialized) git repo, and push it wherever you'll keep your application (Github, Sourcetree etc.).
