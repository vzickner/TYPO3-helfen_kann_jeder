<?php
namespace Querformatik\HelfenKannJeder\Command;

/**
 * Remind controller
 */
class OrganisationCommandController extends \TYPO3\CMS\Extbase\Mvc\Controller\CommandController {

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @var \Querformatik\HelfenKannJeder\Domain\Repository\GroupRepository
	 * @inject
	 */
	protected $groupRepository;

	/**
	 * @var \Querformatik\HelfenKannJeder\Domain\Repository\OrganisationDraftRepository
	 * @inject
	 */
	protected $organisationDraftRepository;

	/**
	 * @var \Querformatik\HelfenKannJeder\Service\LogService
	 * @inject
	 */
	protected $logService;

	public function refreshHelfOMatCacheCommand() {
		$this->groupRepository->generateQuestionOrganisationMappingCache();
	}

	/**
	 * Reenable organisation which are screend from an supporter more than an hour,
	 * because screened organisations can not be modified by an user.
	 *
	 * @param integer $storagePid Id where to read the data from
	 * @param string $administratorMail Mail of the administrator to use as bcc.
	 * @return void
	 */
	public function reenableScreeningOrganisationCommand($storagePid, $administratorMail = null) {
		$draftOrganisations = $this->organisationDraftRepository->findByRequest(3);
		foreach ($draftOrganisations as $draftOrganisation) {
			if ($draftOrganisation->getRequesttime() < time()-3600) {
				$draftOrganisation->setRequesttime(time());
				$draftOrganisation->setRequest(1);
				$this->organisationDraftRepository->update($draftOrganisation);
				$this->logService->insert("Reenabled organisation for edit by the user", $draftOrganisation);
			}
		}
	}
}
?>
