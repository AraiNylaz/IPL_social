<?php
/**
 * Created by PhpStorm.
 * User: lorine
 * Date: 08-12-20
 * Time: 18:03
 */

use PHPUnit\Framework\TestCase;

require "vendor/autoload.php";
require "controllers/AccueilController.php";


class AccueilControllerTest extends TestCase
{

    private $emailAVerifier;

    public function setUp(): void
    {
        parent::setUp();
        $this->emailAVerifier = new AccueilController();
    }

    public function testEmailVideAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailNonVideSansPointAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("je suis une patate magique");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailNonVideSansArobaseAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("j'aime les chats.");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailNonVideAvecPointEtArobaseAuDebutAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail(".@jesuisemailinvalide");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailNonVideAvecPointEtArobaseBienPlaceSansFinAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("l.e@");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailNonVideAvecPointEtArobaseBienPlaceSansFinCorrecteAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lorine.etinne.exempl@devops");
        $this->assertEquals(false, $resultat);
    }
    public function testEmail4NomsTerminologieOkAttenduTrue()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lorine.etienne.delbrouck.mackars@devops.com");
        $this->assertEquals(true, $resultat);
    }
    public function testEmailEnMajusculeAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("LORINE.ETIENNE@STUDENT.VINCI.BE");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailTerminologie3NomsAttenduTrue()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lorine.etienne.delbrouck.mackars@student.vinci.ipl.be");
        $this->assertEquals(true, $resultat);
    }
    public function testEmail2ArobasesAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("l.1@@student.vinci.be");
        $this->assertEquals(false, $resultat);
    }
    public function testEmail2ArobasesVersion2AttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("l.1@student@vinci.be");
        $this->assertEquals(false, $resultat);
    }
    public function testEmail2PointsAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("l.1@student..vinci.be");
        $this->assertEquals(false, $resultat);
    }
    public function testEmail2PointsVersion2AttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("l..1@student.vinci.be");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailCorrectAvecChiffreAttenduTrue()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lor2ne.et5enne.de99b.d7h.t6ht.z5r@st9dent.v4nci.7pl.be");
        $this->assertEquals(true, $resultat);
    }
    public function testEmailIncorrectAvecChiffreAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lor2ne.et5enne.de99b.d7h.t6ht.z5r@st9dent.v4nci.7pl.8e");
        $this->assertEquals(false, $resultat);
    }
    public function testEmailIncorrectAvecEspaceAttenduFalse()
    {
        $resultat = $this->emailAVerifier->analyserEmail("lorine.etienne@g mail.com");
        $this->assertEquals(false, $resultat);
    }



}
