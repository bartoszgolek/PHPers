class EntityManagerFactory
{
    private $config;
    /**
     * @var IDbConfig
     */
    private $dbConfig;

    /**
     * @var IDoctrineConfig
     */
    private $doctrineConfig;

    /**
     * @var array
     */
    private $dbParams = null;

    /**
     * @param IDbConfig $dbConfig
     * @param IDoctrineConfig $doctrineConfig
    */
    public function __construct(IDBConfig $dbConfig, IDoctrineConfig $doctrineConfig)
    {
        $this->dbConfig = $dbConfig;
        $this->doctrineConfig = $doctrineConfig;

        $paths = array($this->doctrineConfig->getModelPath());

        $this->setDbParams();
        $this->config = Setup::createAnnotationMetadataConfiguration($paths, $this->doctrineConfig->getDevMode());
    }

    private function setDbParams()
    {
        $this->dbParams = array(
            'driver' => $this->dbConfig->getDriver(),
            'user' => $this->dbConfig->getUser(),
            'password' => $this->dbConfig->getPassword(),
            'dbname' => $this->dbConfig->getDbName()
        );
    }

    /**
     * @return EntityManagerInterface
     */
    public function createEntityManager()
    {
        return EntityManager::create($this->dbParams, $this->config);
    }
}

//============================

  abstract class DoctrineDao
  {
      /**
       * @var IDoctrineConfig
       */
      private $doctrineConfig;

      /**
       * @var EntityManagerInterface
       */
      private $entityManager;

      /**
       * @param IDoctrineConfig $doctrineConfig
       * @param EntityManagerInterface $entityManager
       */
      public function __construct(IDoctrineConfig $doctrineConfig, EntityManagerInterface $entityManager)
      {
          $this->entityManager = $entityManager;
          $this->doctrineConfig = $doctrineConfig;
      }

      /**
       * @param $shortClassName
       *
       * @return string
       */
      protected function getModelClassName($shortClassName)
      {
          return $this->doctrineConfig->getModelNamespace() . "\\" . $shortClassName;
      }

      /**
       * @return \Doctrine\ORM\EntityManager
       */
      protected function getEntityManager()
      {
          return $this->entityManager;
      }
  }

//============================

  class DoctrineDatabaseModule implements IModule
  {
      public function build(IContainerBuilder $builder)
      {
          $builder
              ->registerType('Saigon\Conpago\Database\Doctrine\EntityManagerFactory');

          $builder
              ->register(function (IContainer $c)
              {
                  /** @var EntityManagerFactory $entityManagerFactory */
                  $entityManagerFactory = $c->resolve('Saigon\Conpago\Database\Doctrine\EntityManagerFactory');

                  return $entityManagerFactory->createEntityManager();
              })
              ->asA('Doctrine\ORM\EntityManagerInterface');
      }
  }
