<?php
$PHPUNIT = null;
if (!$PHPUNIT) {
    if (!$PHPUNIT && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $PHPUNIT = `for %i in (phpunit.bat) do @echo.   %~\$PATH:i)`;
    } else {
        $PHPUNIT = trim(`echo \$PHPUNIT`);
        if (empty($PHPUNIT)) {
            $PHPUNIT = `which phpunit`;
            $PHPUNIT = trim($PHPUNIT);
        }
    }

    $PHPUNIT = trim($PHPUNIT);
    if (!$PHPUNIT) {
        echo "PHPUnit was not found on your OS!" . PHP_EOL;
        exit(1);
    }
}

if (!is_executable($PHPUNIT)) {
    echo "PHPUnit is not executable ($PHPUNIT)";
}

if ($_SERVER['TRAVIS_PHP_VERSION'] == '5.2') {
    //PHPUnit from git clone
    $PHPUNIT = 'php -d include_path=\'.:./phpunit/phpunit/:./phpunit/dbunit/:./phpunit/php-code-coverage/:./phpunit/php-file-iterator/:./phpunit/php-invoker/:./phpunit/php-text-template/:./phpunit/php-timer:./phpunit/php-token-stream:./phpunit/phpunit-mock-objects/:./phpunit/phpunit-selenium/:./phpunit/phpunit-story/:/usr/local/lib/php\' ./phpunit/phpunit/phpunit.php';
} else {
    $PHPUNIT = '../bin/phpunit'; //PHPUnit from composer
}

// locate all tests
$files = glob('{Zend/*/AllTests.php,Zend/*Test.php}', GLOB_BRACE);
sort($files);

// we'll capture the result of each phpunit execution in this value, so we'll know if something broke
$result = 0;

// run through phpunit
foreach ($files as $file) {
    if ($_SERVER['TRAVIS_PHP_VERSION'] === 'hhvm' && $file === 'Zend/CodeGenerator/AllTests.php') {
        echo "Skipping $file on HHVM" . PHP_EOL; //gets stuck on the HHVM
        continue;
    }

    echo "Executing {$file}" . PHP_EOL;
    system($PHPUNIT . ' --stderr -d memory_limit=-1 -d error_reporting=E_ALL\&E_STRICT -d display_errors=1 ' . escapeshellarg($file), $c_result);
    echo PHP_EOL;
    echo "Finished executing {$file}" . PHP_EOL;
    
    if ($c_result) {
        echo PHP_EOL . "Result of $file is $c_result" . PHP_EOL . PHP_EOL;
        $result = $c_result;
    }
}


echo PHP_EOL . "All done. Result: $result" . PHP_EOL;
exit($result);
