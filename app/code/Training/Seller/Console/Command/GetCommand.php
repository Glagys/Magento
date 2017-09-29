<?php
/**
 * Created by PhpStorm.
 * User: training
 * Date: 29/09/17
 * Time: 10:55
 */

namespace Training\Seller\Console\Command;


use Magento\Setup\Console\Command\AbstractSetupCommand;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Training\Seller\Api\SellerRepositoryInterface;

class GetCommand extends AbstractSetupCommand {

    const ID_OPTION = 'id';

    protected $sellerRepository;

    public function __construct(SellerRepositoryInterface $sellerRepository) {
        parent::__construct();
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * Initialization of the command
     *
     * @return void
     */
    protected function configure() {
        $this->setName('training:seller:get')
            ->setDescription('Display seller infos')
            ->setDefinition([
                new InputOption(
                    self::ID_OPTION,
                    '-i',
                    InputOption::VALUE_REQUIRED,
                    'Seller id'
                ),
            ]);
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $identifier = $input->getOption(self::ID_OPTION);

        if(is_null($identifier)) {
            throw new InvalidArgumentException('Argument '. self::ID_OPTION . ' is missing.');
        }

        $seller = $this->sellerRepository->getById($identifier);
        $output->writeln('<info>' . $seller->getName() . '</info>');
    }


}