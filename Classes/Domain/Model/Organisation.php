<?php
/**
 * "Helfen Kann Jeder" Project
 *
 * @description: This class represents an organisation.
 * @author: Valentin Zickner
 *    Querformatik UG (haftungsbeschraenkt)
 *    Technisches Hilfswerk Karlsruhe
 * @date: 2011-03-19
 */
class Tx_HelfenKannJeder_Domain_Model_Organisation extends Tx_Extbase_DomainObject_AbstractEntity {
	/**
	 * @var integer
	 * 	Date of creation
	 */
	protected $crdate = '';

	/**
	 * @var string
	 * 	Name of the organisation
	 */
	protected $name = '';

	/**
	 * @var string
	 * 	Description of the organisation
	 */
	protected $description = '';

	/**
	 * @var Tx_HelfenKannJeder_Domain_Model_OrganisationType
	 * 	Type of the organisation
	 */
	protected $organisationtype;

	/**
	 * @var string
	 * 	Website of the organisation
	 */
	protected $website = '';

	/**
	 * @var string
	 * 	Name and number of the organisation
	 */
	protected $street = '';

	/**
	 * @var string
	 * 	City of the organisation
	 */
	protected $city = '';

	/**
	 * @var integer
	 * 	Zipcode of the organisation
	 */
	protected $zipcode = '';

	/**
	 * @var float
	 */
	protected $longitude;

	/**
	 * @var float
	 */
	protected $latitude;

	/**
	 * @var string
	 */
	protected $telephone;

	/**
	 * @var string
	 */
	protected $telefax;

	/**
	 * @var string
	 */
	protected $logo;

	/**
	 * @var string
	 */
	protected $pictures;

	/**
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 * @lazy
	 */
	protected $feuser;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Workinghour>
	 * @lazy
	 */
	protected $workinghours;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Group>
	 * 	Special groups of the organisation.
	 * @lazy
	 */
	protected $groups;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Employee>
	 * @lazy
	 */
	protected $contactpersons;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Employee>
	 *	Persons of this institute.
	 * @lazy
	 * @cascade remove
	 */
	protected $employees;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Matrix>
	 * @lazy
	 * @cascade remove
	 * @deprecated
	 */
	protected $matrices;

	/**
	 * @var Tx_HelfenKannJeder_Domain_Model_Address
	 */
	protected $defaultaddress;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HelfenKannJeder_Domain_Model_Address>
	 * @lazy
	 * @cascade remove
	 */
	protected $addresses;

	/**
	 * @var Tx_HelfenKannJeder_Domain_Model_OrganisationDraft
	 * @lazy
	 */
	protected $reference;

	/**
	 * @var string
	 */
	protected $hash;

	public function __construct() {
		$this->groups = new Tx_Extbase_Persistence_ObjectStorage();
		$this->workinghours = new Tx_Extbase_Persistence_ObjectStorage();
		$this->employees = new Tx_Extbase_Persistence_ObjectStorage();
		$this->matrices = new Tx_Extbase_Persistence_ObjectStorage();
		$this->contactpersons = new Tx_Extbase_Persistence_ObjectStorage();
		$this->addresses = new Tx_Extbase_Persistence_ObjectStorage();
	}

	public function getCrdate() {
		return $this->crdate;
	}

	public function setCrdate($crdate) {
		$this->crdate = $crdate;
	}

	public function setName($name) {
		$this->name = $name;
	}

	public function getName() {
		return $this->name;
	}

	public function setDescription($description) {
		$this->description = $description;
	}

	public function getDescription() {
		return $this->description;
	}

	public function setOrganisationtype($organisationtype) {
		$this->organisationtype = $organisationtype;
	}

	public function getOrganisationtype() {
		return $this->organisationtype;
	}

	public function setWebsite($website) {
		$this->website = $website;
	}

	public function getWebsite() {
		return $this->website;
	}

	public function setStreet($street) {
		$this->street = $street;
	}

	public function getStreet() {
		return $this->street;
	}

	public function setCity($city) {
		$this->city = $city;
	}

	public function getCity() {
		return $this->city;
	}

	public function setZipcode($zipcode) {
		$this->zipcode = $zipcode;
	}

	public function getZipcode() {
		return $this->zipcode;
	}

	public function setLongitude($longitude) {
		$this->longitude = $longitude;
	}

	public function getLongitude() {
		return $this->longitude;
	}

	public function setLatitude($latitude) {
		$this->latitude = $latitude;
	}

	public function getLatitude() {
		return $this->latitude;
	}

	public function getAddress() {
		return $this->getStreet()."\n".$this->getZipcode()." ".$this->getCity();
	}

	public function setTelephone($telephone) {
		$this->telephone = $telephone;
	}

	public function getTelephone() {
		return $this->telephone;
	}

	public function setTelefax($telefax) {
		$this->telefax = $telefax;
	}

	public function getTelefax() {
		return $this->telefax;
	}

	public function setLogo($logo) {
		$this->logo = $logo;
	}

	public function getLogo() {
		return $this->logo;
	}

	public function setPictures($pictures) {
		$this->pictures = $pictures;
	}

	public function getPictures() {
		return $this->pictures;
	}

	public function setFeuser($feuser) {
		$this->feuser = $feuser;
	}

	public function getFeuser() {
		return $this->feuser;
	}

	public function getContactpersons() {
		return clone $this->contactpersons;
	}

	public function addContactperson($contactperson) {
		$this->contactpersons->attach($contactperson);
	}

	public function removeContactperson($contactperson) {
		$this->contactpersons->detach($contactperson);
	}

	public function getWorkinghours() {
		$workinghours = clone $this->workinghours;
		$workinghours = $workinghours->toArray();
		usort($workinghours, array(&$this, 'sortWorkinghours'));
		return $workinghours;
	}

	protected function sortWorkinghours($a, $b) {
		if ($a == null || $b == null) return 0;

		if ($a->getDay() > $b->getDay()) {
			return 1;
		} else if ($a->getDay() < $b->getDay()) {
			return -1;
		} else if (($a->getStarttimehour()*60+$a->getStarttimeminute()) > ($b->getStarttimehour()*60+$b->getStarttimeminute())) {
			return 1;
		} else {
			return -1;
		}
		return 0;
	}

	public function addWorkinghour($workinghour) {
		$this->workinghours->attach($workinghour);
	}

	public function removeWorkinghour($workinghour) {
		$this->workinghours->detach($workinghour);
	}

	public function getGroups() {
		return clone $this->groups;
	}

	public function addGroup($group) {
		$this->groups->attach($group);
	}

	public function removeGroup($group) {
		$this->groups->detach($group);
	}

	public function setContactperson($contactperson) {
		$this->contactperson = $contactperson;
	}

	public function getContactperson() {
		return $this->contactperson;
	}

	public function getEmployees() {
		return clone $this->employees;
	}

	public function addEmployee($employee) {
		$this->employees->attach($employee);
	}

	public function removeEmployee($employee) {
		$this->employees->detach($employee);
	}

	/**
	 * @deprecated
	 */
	public function getMatrices() {
		return clone $this->matrices;
	}

	/**
	 * @deprecated
	 */
	public function addMatrix($matrix) {
		$this->matrices->attach($matrix);
	}

	public function setDefaultaddress($defaultaddress) {
		$this->defaultaddress = $defaultaddress;
	}

	public function getDefaultaddress() {
		return $this->defaultaddress;
	}

	public function addAddress($address) {
		$this->addresses->attach($address);
	}

	public function removeAddress($address) {
		$this->addresses->detach($address);
	}

	public function getAddresses()  {
		return clone $this->addresses;
	}

	public function setReference($reference) {
		$this->reference = $reference;
	}

	public function getReference() {
		return $this->reference;
	}

	public function removeAllContactpersons() {
		foreach ($this->contactpersons as $person) {
			$this->contactpersons->detach($person);
		}
	}

	public function setHash($hash) {
		$this->hash = $hash;
	}

	public function getHash() {
		return $this->hash;
	}
}
?>