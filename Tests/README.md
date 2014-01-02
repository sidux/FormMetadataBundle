======================
Notes on Testing
======================


The goal for our bundles is for them to be independent libraries. This doesn't mean that they cannot have any dependencies, but rather that all dependencies are declared in the ```composer.json``` file and that the bundle can be tested and developed independently of a symfony project. This is important so that we can run the tests cleanly in a CI environment without having to spawn a whole symfony project for the bundle to be tested in. Also, testing indepdently of a symfony instance ensures that there are no hidden dependencies or configuration specific to a certain instance.

## Running Tests ##

phpunit has been setup to run simply from the root bundle directory. Simply run ```$ phpunit``` and it will run all the tests. If your bundle has dependencies, you will have to also run ```$ php composer.phar install --dev``` to download all the dependencies to run tests with.

## Writing Tests ##

There are three ways to test vendor bundles.

### No Dependencies ###

For bundles that have no references to any other bundles, simply write tests in the ```Tests``` folder extending the standard PHPUnit_Framework_TestCase following standard phpunit conventions. Efforts to avoid needing other dependencies can be made by using dependency injection to inject other libraries into your codebase. These libraries then can be mocked or created by tests. Avoiding symfony's $this->get() would be a good idea too.


### Bundles with Dependencies ###

For bundles that have references to other bundles or the symfony framework, simply declare these references in the composer.json file in the requires section.

Ie.

```
"require": {
    "tedivm/stash-bundle": "dev-master"
}
```

This should fix ```PHP Fatal error:  Class 'xx' not found...``` errors.


### Symfony Functional Tests ###

For some bundles that tightly integrate with symfony, it may be necessary to run full functional tests. Use cases for full functional tests within vendor bundles vs. running them from a bundle inside the project folder or just using unit tests are arguable, but for reference, this is how you do it.

1. Create a test kernel, you may use a working kernel from a symfony project's app/AppKernel.php. Refer to the already created ```Tests/fixtures/framework/TestKernel.php```. Alternatively, you can try using ```JMSCommandBundle generate:test-application```. Untested, but saw references to using something like this during research. https://github.com/schmittjoh/JMSCommandBundle/blob/master/Resources/doc/index.rst
2. Setup the config files in ```Tests/fixtures/framework/config```. Again, you can copy these files from a working symfony framework instance.
3. Add symfony standard edition to require-dev in composer.json. Ie. ```"symfony/framework-standard-edition":"v2.1.4"``` 
4. Add the KERNEL_DIR parameter to phpunit.xml.dist. ```<php> <server name="KERNEL_DIR" value="./Tests/fixtures/framework" /> </php>```
5. Run your tests. You may get errors the first time because there is no cache priming that normally occurs. Run it twice and it may magically work.
