<?php
include 'DBconfig.php';
include 'header.php';

require_once '../pagesFunctions/jobOffer.php';
if (isset($_POST["submit"])) {
    addNewJobOffer();
}
?>

<form action="" method="post" enctype="multipart/form-data">
    <p>Vacature naam</p>
    <input title="jobName" type="text" name="jobName" id="jobName">
    <br>
    <p>Vacature Functie</p>
    <select title="jobFunction" name="jobFunction" id="jobFunction">
        <?php
        require_once '../pagesFunctions/jobOffer.php';
        $jobFunctions = getJobFunctions();
        foreach ($jobFunctions as $jobFunction) {
            echo '<option value="' . $jobFunction['jobfunctionID'] . '"> ' . $jobFunction['functionName'] . ' </option>';
        }
        ?>
    </select>
    <p>Vacature filiaal</p>
    <select title="jobBranch" name="jobBranch" id="jobBranch">
        <?php
        require_once '../pagesFunctions/jobOffer.php';
        $jobBranches = getJobBranches();
        foreach ($jobBranches as $jobBranch) {
            echo '<option value=" ' . $jobBranch['jobbranchID'] . ' "> ' . $jobBranch['brancheName'] . ' </option>';
        }
        ?>
    </select>
    <br>
    <p>Bestand uploaden</p>
    <input type="file" name="fileToUpload" id="fileToUpload" accept=".pdf,.doc">
    <br>
    <p>Of typ zelf een vacature</p>
    <input title="jobDescription" type="text" name="jobDescription" id="jobDescription">
    <br>
    <input type="submit" value="Vacature online zetten" name="submit">
</form>
