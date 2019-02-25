<?php

namespace UserManagement\CommonBundle\Command;
use UserManagement\UserBundle\Entity;
use UserManagement\UserBundle\Entity\RewardCategory;
use UserManagement\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ImportAllCommand
    extends ContainerAwareCommand {

    protected function configure() {
        $this
            ->setName('database:import:csv')
            ->setDescription('Lance import Csv')
            ->addArgument('path', InputArgument::REQUIRED, 'chemin du fichier à importer')
            ->addArgument('mode', InputArgument::REQUIRED, 'clean database or not')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $path = $input->getArgument('path');
        $mode = $input->getArgument('mode');


        ini_set("memory_limit", -1);
        ini_set("auto_detect_line_endings", true);
        $em          = $this->getContainer()->get('doctrine')->getManager();

        if ($mode == true)
            $this->delete_all($input, $output, $em);
        $this->import_csv($input, $output, $path, $em);
        $output->writeln("---------------------------------------------------");
        $output->writeln("----------------------END--------------------------");
        }

    // imports

    protected function delete_all($input, $output, $em)
    {

    }


    protected function import_csv(InputInterface $input, OutputInterface $output, $file, $em)
    {
        $row     = 0;

        if(($handle = fopen($file, "r")) !== false) {
            $output->writeln("Fichier ouvert");
            while(($data = fgetcsv($handle, 0, ";", '"')) !== false) {
                $row++;

                $data = array_map("utf8_encode", $data);
                $data = array_map("trim", $data);

                //Ligne d'entête (on ne garde que les attributs)
                if($row == 1) {
                    $headers = $data;
                    for($i = 0; $i < 5; $i++) {
                        unset($headers[$i]);
                    }
                    continue 1;

                }
                // DEBUT PARSE

                $first_name = $data[0];
                $last_name = $data[1];
                $amount = $data[2];
                $project_name = $data[3];
                $CategName = $data[4];
                $CategValue = $data[5];
                // FIN PARSE
                // DEBUT INSTANTIE
                if ($first_name == null)
                {

                }
                else if ($last_name == null)
                {

                }
                else if ($amount == null)
                {

                }
                else if ($project_name == null)
                {

                }
                else if ($CategName == null)
                {

                }
                else if ($CategValue == null)
                {

                }
                else
                {

                    $NewRewardCateg = $this->load_RewardCategory($em, $row, $output, $CategName);
                    if ($NewRewardCateg != null)
                        $output->writeln("ligne[" . ($row - 1) . "] WARNING : RewardCateg [" . $CategName . "] Already Exist");
                    else
                    {
                       $NewRewardCateg = $this->create_RewardCategory($em, $row, $output, $CategName);
                    }

                    $NewUser = $this->load_User($em, $row, $output, $first_name, $last_name);
                    if ($NewUser != null)
                    {
                        $output->writeln("ligne[" . ($row - 1) . "] WARNING : User [" . $first_name . "][" . $last_name . "] Already Exist");
                    }
                    else
                    {
                        $NewUser = $this->create_User($em, $row, $output, $first_name, $last_name, $amount, $project_name, $NewRewardCateg, $CategValue);
                    }
                    $output->writeln("---");
                    $output->writeln("");
                    //break;
                }
                
                // FIN INSTANTIE
            }
        }
        fclose($handle);
        $output->writeln("");
        $output->writeln(($row - 1) . " IMPORTED");
        $output->writeln("TERMINATED-GAME-----------------------------------");
        $output->writeln("");
        $output->writeln("");
    }

    protected function create_RewardCategory($em, $row, $output, $CategName)
    {
        $NewCateg = $em->getRepository("UserBundle:RewardCategory")->findOneBy(
            ["name" => $CategName]);
        if($NewCateg == null) {
            $NewCateg = new RewardCategory();
            $NewCateg->setName($CategName);
            $em->persist($NewCateg);
            $em->flush();
            $output->writeln("ligne[" . ($row - 1) . "] SUCCES  : RewardCateg [". $CategName . "] Created");
            return ($NewCateg);
        }
        else
        {
            $output->writeln("ligne[" . ($row - 1) . "] WARNING  : RewardCateg [". $CategName . "] Already Exist");
            return ($NewCateg);
        }
    }

    protected function create_User($em, $row, $output, $first_name, $last_name, $amount, $project_name, $NewRewardCateg, $CategValue)
    {
        $NewUser = $em->getRepository("UserBundle:User")->findOneBy(array(
            'firstName' => $first_name, 
            'lastName' => $last_name));
        if($NewUser == null) {
            $NewUser = new User();
            $NewUser->setFirstName($first_name);
            $NewUser->setLastName($last_name);
            $NewUser->setAmount($amount);
            $NewUser->setProjectName($project_name);
            $NewUser->setRewardCount($CategValue);
            $NewUser->setRewardCateg($NewRewardCateg);
            $em->persist($NewUser);
            $em->flush();
            $output->writeln("ligne[" . ($row - 1) . "] SUCCES  : User [" . $first_name . "][" . $last_name . "] Created");
            return ($NewUser);
        }
        else
        {
            $output->writeln("ligne[" . ($row - 1) . "] WARNING  : User [" . $first_name . "][" . $last_name . "] Already Exist");
            return ($NewUser);
        }
    }

    // LOAD

    protected function load_RewardCategory($em, $row, $output, $CategName)
    {
        $NewCateg = $em->getRepository("UserBundle:RewardCategory")->findOneBy(
            ["name" => $CategName]);
        return $NewCateg;
    }

    protected function load_User($em, $row, $output, $first_name, $last_name)
    {
        $NewUser = $em->getRepository("UserBundle:User")->findOneBy(array(
            'firstName' => $first_name, 
            'lastName' => $last_name));
        return $NewUser;
    }


}

?>