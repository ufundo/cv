<?php
namespace Civi\Cv;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Application extends \Symfony\Component\Console\Application {

  /**
   * Primary entry point for execution of the standalone command.
   */
  public static function main($binDir) {
    $application = new Application('cv', '@package_version@');
    $application->run();
  }

  public function __construct($name = 'UNKNOWN', $version = 'UNKNOWN') {
    parent::__construct($name, $version);
    $this->setCatchExceptions(TRUE);
    $this->addCommands($this->createCommands());
  }

  /**
   * Construct command objects
   *
   * @return array of Symfony Command objects
   */
  public function createCommands() {
    $commands = array();
    $commands[] = new \Civi\Cv\Command\ApiCommand();
    $commands[] = new \Civi\Cv\Command\BootCommand();
    $commands[] = new \Civi\Cv\Command\EvalCommand();
    $commands[] = new \Civi\Cv\Command\ShowCommand();
    $commands[] = new \Civi\Cv\Command\ScriptCommand();
    $commands[] = new \Civi\Cv\Command\UrlCommand();
    return $commands;
  }

  /**
   * Determine the default output mode.
   *
   * @return string
   *   Ex: 'json', 'shell', 'php', 'pretty', 'none'
   */
  public static function getDefaultOut() {
    $e = getenv('CV_OUTPUT');
    return $e ? $e : 'json';
  }

}