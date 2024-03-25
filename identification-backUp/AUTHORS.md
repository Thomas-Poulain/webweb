Le groupe identification du projet Balabox est composé des membres suivants : 

- Thomas POULAIN
Thomas s'est entièrement occupé de la Raspberry Pi. Il a dédié un temps de recherche durant le projet afin
de comprendre le fonctionnement de MoodleBox, quelles seront les méthodes et les API utilisés dans notre projet. En se partageant la tâche avec
Michaël BESILY, il s'est occupé de la partie dite back-end de la partie identification du projet Balabox. Il
s'occupe également de la relation client en organisant des rendez-vous nous permettant d'avancer sur un
chemin sûr, validé par la cliente du projet. Lorsque les tests ne peuvent pas être effectués localement par
Eve-Anne, il s'en occupe directement sur la Raspberry et corrige les éventuelles erreurs. Il adapte également
les scripts reçus pour la Raspberry, car quelques différences peuvent être présentes et ont besoin d'être
adaptées. Thomas a réalisé des jeux de test en amont afin d'être plus efficace lors de la première utilisation
de la Raspberry notamment pour la connexion avec l'API Moodle. 

- Michaël BESILY
Comme dit ci-dessus, Michaël s'est occupé du back avec Thomas POULAIN. Il a également crée une machine
virtuelle prenant comme base la Raspberry Pi de la cliente de notre projet Balabox. Nommée Balabox Manager,
cette machine virtuelle nous permet à nous ainsi qu'aux autres équipes, décidant librement de l'utiliser ou
non, de tester leurs scripts sans avoir accès à la Raspberry. En association avec Thomas POULAIN, ils ont créé
le script de connexion, de création d'utilisateur et de création de classe. 
Il a également réfléchi à la conception de l'application côté scripts. 


- Eve-Anne OFFREDI
Eve-Anne s'est occupée de l'interface utilisateur, de la charte graphique jusqu'à la réalisation des vues de 
la partie identification de l'application Balabox. Elle a également réalisé les controllers, la génération
des pdf permettant au super-admin et aux professeurs de récupérer les informations des élèves afin de les 
aider efficacement. Elle s'est également chargée du système de lecture d'un fichier CSV et du format de ce
dernier, en créant des fichiers CSV tests. Le développement fait par Eve-Anne est testé, dans la mesure du
possible, sur un serveur php local. Les tests restant sont délégués à Thomas POULAIN.