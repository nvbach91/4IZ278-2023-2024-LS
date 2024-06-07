-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Pát 07. čen 2024, 14:58
-- Verze serveru: 10.5.19-MariaDB-0+deb11u2
-- Verze PHP: 8.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `chav07`
--
CREATE DATABASE IF NOT EXISTS `chav07` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chav07`;

-- --------------------------------------------------------

--
-- Struktura tabulky `AUTHORS`
--

CREATE TABLE `AUTHORS` (
  `ID_AUTHOR` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `AUTHORS`
--

INSERT INTO `AUTHORS` (`ID_AUTHOR`, `NAME`) VALUES
(1, 'Karel Čapek'),
(2, 'George Orwell'),
(3, 'Andrzej Sapkowski'),
(4, 'Stephen Prata'),
(5, 'George R.R. Martin'),
(6, 'J. R. R. Tolkien'),
(7, 'Karin Lednická'),
(8, 'Robert Bryndza'),
(9, 'Stephen King'),
(10, 'Ken Follett'),
(11, 'Lucie Bechynková'),
(12, 'Jo Nesbø');

-- --------------------------------------------------------

--
-- Struktura tabulky `BOOKS`
--

CREATE TABLE `BOOKS` (
  `ID_BOOK` int(11) NOT NULL,
  `ID_AUTHOR` int(11) NOT NULL,
  `TITLE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(3000) NOT NULL,
  `PRICE` float(8,2) NOT NULL,
  `STOCK` int(11) NOT NULL,
  `ISBN13` char(17) DEFAULT NULL,
  `ISBN10` char(13) DEFAULT NULL,
  `IMAGE_URL` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `BOOKS`
--

INSERT INTO `BOOKS` (`ID_BOOK`, `ID_AUTHOR`, `TITLE`, `DESCRIPTION`, `PRICE`, `STOCK`, `ISBN13`, `ISBN10`, `IMAGE_URL`) VALUES
(1, 1, 'R.U.R.', 'Slavná antiutopická divadelní hra Karla Čapka z roku 1920, ve které poprvé zaznělo slovo robot, náleží do žánru sci-fi. Ústředním tématem je zkáza lidstva skrze příliš vyspělou techniku, která se vymkla kontrole. Aby se lidé zbavili nutnosti pracovat, stvoří si umělé sluhy–roboty, kteří se však vzbouří a lidstvo vyhladí. Nakonec ale dvojice těchto umělých stvoření, původně neschopná citů, mezi sebou objeví lásku a s požehnáním starého vynálezce se stanou novým Adamem a Evou.', 390.00, 2, '978-80-7390-062-5', NULL, '/images/rur.jpg'),
(2, 2, '1984', 'Jedno z nejznámějších děl světové literatury v sobě pojí prvky společensko-politického a vědecko-fantastického románu. Je obžalobou komunistické diktatury, která v roce1984 všechno ovládala. Čtenář se ponoří do osudů čestného, citlivého a uvažujícího Winstona Smitha, který se vzepře systému, za což zaplatí krutou daň. Orwell touto knihou předpověděl dnešní realitu.', 255.00, 10, '978-80-7309-808-7', '', '/images/1984.jpg'),
(3, 3, 'Farma zvířat', 'Všechna zvířata jsou si rovna, ale některá jsou si rovnější. Když zvířata z Panské farmy svrhnou svého nezodpovědného pána a převezmou kontrolu nad farmou, domnívají se, že je čeká nový a svobodný život. Farma zvířat, jak svůj domov přejmenují, je zorganizována tak, aby si v ní všichni zvířecí tvorové, kteří splňují sedm přikázání, byli rovni.… Přejít na celý popis.', 178.00, 0, '978-80-7546-369-2', '', '/images/farma-zvirat-9788075463692_116.jpg'),
(4, 3, 'Zaklínač I: Poslední přání', 'Zaklínač… Ošlehaný muž bez věku, jehož bílé vlasy nejsou znakem stáří, ale mutace, kterou musel podstoupit. Placený i dobrovolný likvidátor prapodivných tvorů: mantichor, trollů, vidlohonů, strig, amfisbain - pokud ovšem ohrožují lidský rod; v takovém případě zabíjí i bytost zvanou člověk. Prvotřídní, skvělý bojovník, který není neporazitelný ani nezranitelný - naopak, téměř z každého dobrodružství si odnáší další šrámy na těle i na duši.\r\n\r\nNově přeložené geraltovské povídky ze Stříbrného meče, něco z Věčného ohně a Meče osudu + kompletní povídka Hlas rozumu kde Geralt vysvětluje, jak to všechno začalo.', 299.00, 12, '978-80-7477-079-1', NULL, '/images/zaklinac-i-posledni-prani-9788074770791_1.jpg'),
(5, 3, 'Zaklínač II: Meč osudu', 'Sedm příběhů zaklínače Geralta. Meč osudu je několikátou povídkovou sbírkou o Geraltovi, trubadúrovi Marigoldovi čarodějce a Yennefer, kde se jejich osudy všemožně kříží a rozpojují, aby se nakonec všichni opět setkali.Hlavním hrdinou tvorby Andrzeje Sapkowského je zaklínač Geralt z Rivie. Jako nájemný hubitel upírů, vlkodlaků a všemožných nebezpečných netvorů pochopitelně ovládá bojové a magické techniky nezbytné pro své zaměstnání. Nicméně není pouze chladnokrevným profesionálem, a už vůbec ne jedním ze superhrdinů, jimiž se žánr fantasy jen hemží. Postupně vychází najevo, že neměl možnost si svůj osud svobodně zvolit, ale naopak je nucen draze platit za schopnosti a dovednosti nedosažitelné a vesměs též nepochopitelné běžným smrtelníkům. Proto vyvolává strach a zároveň nevraživost a odpor těch, jejichž životy vlastně chrání. Přes své pozitivní působení jsou zaklínači odsouzeni k vyhnanství na samém okraji společnosti, která sice působí vnějškově středověkým dojmem, avšak mnoho jejich atributů je převzatých ze současnosti.', 249.00, 6, '978-80-7477-080-7', NULL, '/images/zaklinac-ii-mec-osudu-broz-4-vydani-9788074770807.jpg'),
(6, 3, 'Zaklínač III: Krev elfů', 'Meč, magie a vyzvědačké intriky. První část legendární Sapkowského ságy o zaklínači Geraltovi a jeho sudbě - Ciri z Cintry. Zaklínač pečuje o plamen, který může zapálit celý svět..', 268.00, 14, '978-80-7477-081-4', '', '/images/zaklinac-iii-krev-elfu-9788074770814_46.jpg'),
(7, 3, 'Zaklínač IV: Čas opovržení', 'Druhý román o Geraltovi a Ciri.', 259.00, 0, '978-80-7477-082-1', NULL, '/images/zaklinac-iv-cas-opovrzeni-9788074770821.png'),
(8, 3, 'Zaklínač V: Křest ohněm', 'Svět zachvátily plameny běsnící války. Čarodějové intrikují a Ciri, prchající před smrtelným nebezpečím, se ocitá daleko od Geralta i Yennefer. Sama, opuštěná, ztracená - s pocitem, že byla zrazena těmi, kterým bezmezně věřila. Pátrání po zmizelé princezně však navzdory zprávám o její smrti stále pokračuje, a Geralt žel není jediný, kdo Ciri hledá. Zaklínač i Lvíče z Cintry se stali objektem vysoké politické hry, která může zabít nejen je, ale také všechny, kdo jsou jim blízcí. Ostatně, věštba přece tvrdí, že princezně kráčí v patách smrt...', 259.00, 11, '978-80-7477-084-5', '', '/images/zaklinac-v-krest-ohnem-9788074770845_5.png'),
(9, 3, 'Zaklínač VI: Věž vlaštovky', 'Čtvrtá část Ságy o Zaklínači.Kdyby se toho dne po setmění někdo přikradl k chatrči v mokřinách a škvírou v okenici se podíval do světnice, spatřil by i v chabém osvětlení bělovousého starce soustředěně naslouchajícího popelavé dívce sedící na špalku u krbu...Ciri se léčí z těžkých, téměř smrtelných zranění na samotě v bažinách Pereplutu a vypráví starému poustevníkovi o všem, co se událo od chvíle, kdy na Thaneddu prošla portálem ve Věži racka. Postupně vychází najevo, že jedinou možností, jak uniknout pronásledovatelům a dostat se domů, je projít mytickým portálem ve Věži vlaštovky. Věž však mohou spatřit jen Vyvolení...', 289.00, 3, '978-80-7477-085-2', NULL, '/images/vez-vlastovky.jpg'),
(10, 4, 'Mistrovství v C++', 'Hledáte jediný zdroj informací k C++, ve kterém byste našli vše potřebné k ovládnutí tohotojazyka? Čtvrté aktualizované vydání světového bestselleru vás provede světem C++ od prvníchjednoduchých programů až po komplexní projekty. S jazykem se seznámíte na mnohapraktických ukázkách, nově nabyté znalosti si můžete v závěru každé kapitoly zopakovata ověřit na otázkách a programátorských cvičeních.', 849.00, 0, '978-80-251-3828-1', '', '/images/8cd0567a42a34e8e9518676514e81e99fb84b946.jpg'),
(11, 5, 'Hra o trůny', 'Zima se blíží. Dnes již klasická slova, která nejlépe vystihují epickou ságu George R. R. Martina Píseň ledu a ohně. Království Západozemí zažívají dlouhé léto, po němž musí následovat krutá zima. Ale ještě před ní a předtím, než se vrátí Jiní, se rozehrává hra o trůny, kterých je daleko méně než uchazečů. Snad jediný, kdo o Železný trůn nestojí, je lord Eddard Stark, strážce severu. Proto se právě on musí stát hybatelem událostí, které všechno změní. Epické vyprávění s desítkami postav se díky seriálu HBO stalo nejúspěšnější fantasy ságou od dob Pána prstenů. Na celém světě má miliony nadšených fanoušků, kteří netrpělivě čekají na každé pokračování. Hra o trůny vychází česky v novém překladu a úpravě.', 648.00, 0, '978-80-257-2283-1', '', '/images/88d5e7d6de9dfe73cd2878f922604bc560c80e6e.jpg'),
(12, 6, 'Společenstvo prstenu', 'V dávných dobách vykovali elfští kováři prsteny moci, netušili však, že Temný pán Sauron dal vyrobit ještě jeden prsten, který měl vládnout všem. Spojené armády lidí a elfů nakonec Saurona porazily a prsten mu odňaly, tato magická věc se však ztratila, aby po mnoha letech padla do rukou Bilba Pytlíka. Trilogie Pán prstenů vypráví o nebezpečné cestě Bilbova příbuzného Froda, který musí opustit ospalou vesničku Hobitín v Kraji a vydat se na nebezpečnou cestu přes celou Středozem k Puklinám osudu, aby zničil Prsten, a zmařil tak Sauronovy temné plány. První část trilogie sleduje, jak se díky čaroději Gandalfovi zformuje společenstvo, složené ze zástupců lidí, elfů, trpaslíků a hobitů, které má Froda na jeho cestě doprovázet, jak začne cesta společenstva a jak se posléze kvůli moci prstenu a snahám nepřátel společenstvo rozpadá…', 349.00, 14, '978-80-7203-726-1', '', '/images/068b2d768a8979a10cfdf3ef596755df37f63931.jpg'),
(13, 6, 'Návrat krále', 'V dávných dobách vykovali elfští kováři prsteny moci. Netušili však, že Temný pán Sauron dal vyrobit ještě jeden prsten, který měl vládnout všem. Trilogie Pán prstenů vypráví o nebezpečné cestě Bilbova příbuzného Froda, který musí opustit ospalou vesničku Hobitín v Kraji a vydat se na nebezpečnou cestu přes celou Středozem k Puklinám osudu, aby zničil Prsten, a zmařil tak Sauronovy temné plány. Velkolepý závěrečný díl celé trilogie paralelně vypráví jednak o horečných válečných přípravách a o nelehkém sjednocování těch, kdo mají odvahu a vůli čelit Temnému pánu a jeho nelidským armádám, jednak o putování Froda, Sama a Gluma do Mordoru a k Hoře osudu. V epilogu velkých dějů se ještě temná moc vzmáhá k podlým činům, kterým je třeba zabránit. Odchodem mnohých hrdinů knihy do Šedých přístavů končí Tolkienovo vyprávění i jedna éra v dějinách Středozemě.', 399.00, 0, '978-80-7203-728-5', '', '/images/7d9d265e53cb70519799064397984909ab2ab86e.jpg'),
(14, 7, 'Šikmý kostel 3', 'Jak dlouho trvá válka po tom, co skončí?\r\n\r\nNavždy, pokud jí člověk prošel. Ptejme se spíše, jak může zaplnit prázdnotu po zavražděných blízkých nebo po uneseném dítěti. Čím bude zahánět vzpomínky na děsivý teror Němců nebo nechtěnou tělesnou lásku Rusů. Někdo všechno zamkne na dno duše a ráno co ráno si namlouvá, že co bylo, bylo, teď je prostě třeba jít dál. Jiný se nechá zahltit žalem; další přetaví prožité v nenávist. A ještě jiný ve víru, že to bude právě on, kdo pomůže vytvořit nový, lepší svět. ​\r\n\r\nJak dlouho trvá, než člověk přijde o iluze?\r\n\r\nTím déle, oč horoucněji se k nim upínal. Možná začne váhat při prvních soudružských podlostech, možná prozře až poté, co kvůli zběsilému plnění plánu začnou umírat lidé a následný monstrproces přenese vinu na ty, kteří se nesmyslné honbě za tunami uhlí snažili zabránit. Pak už bude záležet jen na něm, jestli zahořkne, uchýlí se k prospěchářství, anebo se pokusí znovu nalézt společnou řeč s těmi, kteří věděli (nebo přinejmenším tušili) od samého začátku. ​\r\n\r\nJak dlouho trvá, než člověk uteče do rezignace?\r\n\r\nDokud nezjistí, že už mu zbyla vůle a síla jen na to, aby se uzavřel do čtyř zdí vlastního života. Tam si může zpočátku nalhávat, že na něj vnější svět nedosáhne, pokud zásadně neporušuje jeho pravidla. Aby nakonec zjistil, že právě v této úvaze se dopustil největšího omylu. ​\r\n\r\nA jak dlouho trvá, než se ztratí dvacetitisícové město?', 429.00, 65, '978-80-88362-16-6', '', '/images/03f90e2cc78ed63802a890c0ef62303b723de3ce.jpg'),
(15, 8, 'Anděl smrti', 'Když najde detektiv šéfinspektor Erika Fosterová vysoce postaveného politika Nevilla Lomase nahého, svázaného a mrtvého ve vlastní posteli, vedení Metropolitní policie rychle rozhodne, že jeho smrt není potřeba vyšetřovat. Případ je odložený, ovšem jen do chvíle, kdy je nalezena mrtvá i nadějná fotbalová hvězda. Erika a její tým navíc s těmito vraždami spojí i smrt známého režiséra. Policie už nemůže ignorovat to, co je očividné: v Londýně řádí sériový vrah, který si chce vyřídit účty.\r\n\r\nVýsledky vyšetřování jsou ovšem trochu matoucí. Na záběrech z průmyslových kamer se objeví pět podezřelých žen... a všechny jsou si k nerozeznání podobné. Při pátrání po jejich totožnosti Erika několikrát narazí na zmínku o sexuální pracovnici, která má špínu na tolik vlivných mužů, že to znervózňuje i ty nejmocnější politiky a vedení Metropolitní policie.\r\n\r\nČas do dalšího útoku vraha se krátí a je na Erice, aby rozpletla síť důkazů a zodpověděla zásadní otázky: Co spojuje oběti dohromady, kdo další je zapleten do skandálu a jak daleko jsou mocní ochotní zajít, aby ochránili své vlastní z nword', 329.00, 12, '978-80-271-3688-9', '', '/images/9dc0b9eea875b0918d464ab2f3e5909672dd49ff.jpg'),
(16, 9, 'HOLLY', 'Holly Gibneyová, jedna z nejpodmanivějších a nejvynalézavějších postav Stephena Kinga, se vrací v tomto napínavém románu, aby vyřešila hrůznou pravdu o několikanásobném zmizení v městečku na Středozápadě.\r\n\r\nHolly Stephena Kinga představuje triumfální návrat oblíbené postavy Holly Gibneyové. Čtenáři byli svědky Hollyina postupného přerodu z plaché (ale také statečné) samotářky v románu Pan Mercedes přes partnerku Billa Hodgese v knize Právo nálezce až po plnohodnotnou, chytrou a občas drsnou soukromou detektivku v knize Outsider. V novém Kingově románu je Holly odkázána sama na sebe a stojí proti dvojici nepředstavitelně zvrácených a skvěle maskovaných protivníků.\r\n\r\nKdyž Penny Dahlová zavolá do detektivní agentury Finders Keepers a doufá, že jí pomůžou najít její ztracenou dceru, Holly se zdráhá případ přijmout. Její partner Pete má covid. Její velmi komplikovaná matka právě zemřela. A Holly má být na dovolené. Ale něco v zoufalém hlase Penny Dahlové způsobí, že Holly nemůže odmítnout.\r\n\r\nJen pár bloků od místa, kde zmizela Bonnie Dahlová, žijí profesoři Rodney a Emily Harrisovi. Jsou to manželé osmdesátníci, oddaní jeden druhému a celoživotní akademici v částečném důchodu. Ve sklepě svého dobře udržovaného, knihami obloženého domu, však ukrývají hrozivé tajemství, které možná souvisí s Bonniiným zmizením. A ukáže se, že je téměř nemožné odhalit, co mají za lubem: jsou bystří, trpěliví a bezohlední.\r\n\r\nHolly musí zapojit všechny své ohromné schopnosti, aby v tomto novém mrazivém mistrovském díle Stephena Kinga přechytračila a přelstila zvrácené profesory.', 379.00, 20, '978-80-7593-599-1', '', '/images/0a52abc589dcbd30958a2b1a402dfdffb40275ad.jpg'),
(17, 10, 'Zbroj světla', 'Pilíře země, Na věky věků, Ohnivý sloup a Večer a jitro, čtyři monumentální historické bestsellery Kena Folletta dokázaly oslovit miliony čtenářů na celém světě. Zatímco poslední uvedené dílo tuto kingesbridgeskou ságu dějové předchází, autorův nejnovější román Zbroj světla v časové linii opět pokračuje a přivádí nás do období napoleonských válek a průmyslové revoluce.\r\nZbroj světla předznamenává nový úsvit pro Kingsbridge v Anglii, kde se pokrok střetává s tradicí a třídní boje zasahují do všech částí společnosti, zatímco v Evropě válka pohlcuje celý kontinent a šíří se i dál.\r\nV roce 1770 byl vynalezen spřádací stroj a s ním se v průběhu jedné generace všude změnil život lidí. Zemi zachvacuje nebývalá průmyslová změna, při které se životy dělníků v prosperujících kingsbridgeských textilkách mění v mizérii. V důsledku rozmáhající se modernizace a nástupu nových strojů se pracovní místa stávají zastaralá a zbytečná, rodiny se rozpadají. V této době, kdy se blíží mezinárodní konflikt, přichází skupina kingsbridgeských obyvatel – zahrnující přadlenu Sal Clithoreovou, tkalce Davida Shovellera a Kita, Salina vynalézavého a houževnatého syna –, kteří v generačním zápase hledají osvícení a bojují za budoucnost bez útlaku.\r\nSvět naplněný nepokoji zápasí o zvládnutí tohoto nového světového řádu: manžel jedné matky přijde o život při pracovním úrazu v důsledku hrubé nedbalosti; mladá žena bojuje o financování své školy pro chudé děti; mladý muž, který má dobré úmysly, nečekaně zdědí krachující podnik; jeden muž nemilosrdně chrání své bohatství, ať to stojí, co to stojí.\r\nMezitím se se stále hlasitěji ozývá válečný pokřik z Francie, kde Napoleon začíná uskutečňovat násilný plán s cílem stát se pánem světa. Zatímco se zpochybňované společenské instituce hroutí, promítají se změny i do životů našich postav, jimž nezbývá než počítat s budoucností a světem, který musí znovu vybudovat z válečných trosek.\r\nZbroj světla, tento úchvatný další díl kingsbridgeské ságy, nás vrhá na bojiště mezi soucitem a chamtivostí, láskou a nenávistí, pokrokem a tradicí, a my prostřednictvím každé postavy dostáváme novou perspektivu na seizmické změny, které otřásly světem v Evropě devatenáctého století.', 420.00, 12, '978-80-242-9715-6', '', '/images/87f1c77fe15877014cff8f7f9fac366426aeea0a.jpg'),
(18, 11, 'Opravdové zločiny 3', 'Brutální i záhadné případy opět ožívají v nervydrásající sbírce příběhů. Lucie Bechynková, jedna z tvůrkyň podcastového fenoménu Opravdové zločiny, vás provede ponurými událostmi z různých koutů světa. Čeká vás jeden z nejhorších sériových vrahů německé historie, francouzský zabiják spalující své oběti v kamnech, americký Dům hrůzy nebo neuvěřitelný osud stalkera, který se stal partnerem zpěvačky švédské skupiny ABBA. A tím to nekončí – připravte se, že na povrch vyplavou nejděsivější stránky lidské povahy…', 225.00, 7, '978-80-7448-105-5', '', '/images/747b04a678df61b951e41b6ee05a8484aa96ffa9.jpg'),
(19, 12, 'Noční dům', 'Čtrnáctiletému Richardovi, který se po tragických událostech přistěhoval k tetě a strýci do městečka Ballantyne, se smůla lepí na paty. Když přemluví spolužáka Toma, aby z telefonní budky někomu náhodně zavolal a vystřelil si z něj, vypadá to jako nevinná lumpárna. Jenže sluchátko vzápětí Toma sežere. Richardovi nikdo nevěří a po zmizení dalšího spolužáka ho čeká pobyt v nápravném zařízení. Jak dokáže, co se doopravdy stalo? A není náhodou všechno úplně jinak?', 329.00, 12, '978-80-7662-660-7', '', '/images/16988c021868e30ebe4915c39a60faedde69fb10.jpg'),
(20, 12, 'Nůž', 'Harry Hole balancuje nad propastí. Už mnohokrát se probudil s temným tušením, prázdnou hlavou a kocovinou jako trám. Tentokrát je ovšem probuzení horší než jindy. Kdysi slavný kriminalista má na rukou i kalhotách krev a z předchozího večera si nepamatuje vůbec nic. Střípky událostí však postupně vyplouvají na povrch a Harry si začíná přát, aby se byl vůbec neprobudil. Protože i zlý sen je lepší než krutá realita, jíž musí čelit.', 289.00, 28, '978-80-7662-408-5', '', '/images/6b761a74b555eeed9bec1db586befaa80cf8d230.jpg'),
(21, 12, 'Spasitel', '6. díl krimi série o detektivu Harrym Holeovi. Píše se srpen 1991. Na letním táboře Armády spásy je znásilněna čtrnáctiletá dívka. O 12 let později… v Oslu panuje nejen adventní atmosféra, ale také největší mráz za posledních čtyřiadvacet let. Armáda spásy pořádá na náměstí bratří Egerových tradiční předvánoční pouliční koncerty a rozdává z velkého kotle polévku potřebným. 16. prosince v podvečer se do zvuků hudby ozve výstřel. Voják stojící u kotle s polévkou padá mrtev k zemi.', 319.00, 16, '978-80-7662-332-3', '', '/images/2287a62dd7c26044fde169f37a49c303885b7256.jpg');

-- --------------------------------------------------------

--
-- Struktura tabulky `HAS`
--

CREATE TABLE `HAS` (
  `ID_BOOK` int(11) NOT NULL,
  `ID_ORDER` int(11) NOT NULL,
  `COUNT` int(11) NOT NULL,
  `PRICE` float(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `HAS`
--

INSERT INTO `HAS` (`ID_BOOK`, `ID_ORDER`, `COUNT`, `PRICE`) VALUES
(1, 24, 1, 390.00),
(2, 10, 1, 254.00),
(2, 11, 1, 254.00),
(2, 12, 1, 254.00),
(2, 25, 1, 255.00),
(3, 13, 2, 178.00),
(4, 17, 1, 299.00),
(6, 10, 4, 268.00),
(6, 14, 1, 268.00),
(6, 15, 1, 268.00),
(6, 16, 1, 268.00),
(6, 17, 1, 268.00),
(9, 18, 1, 289.00),
(9, 19, 1, 289.00),
(9, 22, 1, 289.00),
(10, 11, 1, 849.00),
(10, 17, 1, 849.00),
(10, 26, 3, 849.00),
(11, 11, 1, 648.00),
(11, 23, 1, 648.00),
(11, 27, 20, 648.00),
(13, 31, 1, 399.00),
(13, 34, 1, 399.00),
(16, 29, 14, 379.00),
(16, 33, 1, 379.00),
(18, 30, 1, 225.00),
(20, 28, 1, 289.00),
(20, 32, 2, 289.00);

-- --------------------------------------------------------

--
-- Struktura tabulky `ORDERS`
--

CREATE TABLE `ORDERS` (
  `ID_ORDER` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `PAID` tinyint(1) NOT NULL,
  `DELIVERED` tinyint(1) NOT NULL,
  `STREET` varchar(255) NOT NULL,
  `CITY` varchar(255) NOT NULL,
  `POST_CODE` varchar(20) NOT NULL,
  `PHONE` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `ORDERS`
--

INSERT INTO `ORDERS` (`ID_ORDER`, `USER_ID`, `PAID`, `DELIVERED`, `STREET`, `CITY`, `POST_CODE`, `PHONE`) VALUES
(7, 19, 1, 0, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(8, 19, 0, 1, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(9, 19, 1, 1, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(10, 19, 0, 0, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(11, 19, 0, 0, 'Kokotska', 'New York', '500000', '721812230'),
(12, 19, 1, 0, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(13, 19, 1, 0, 'Revolucni 94', 'Dobroviz', '252 61', '721812230'),
(14, 11, 0, 0, 'Republiky 55', 'Praha', '100 00', '555777888'),
(15, 11, 0, 1, 'Republiky 55', 'Praha', '100 00', '555777888'),
(16, 11, 1, 1, 'Pražská 2155/5', 'Praha', '120 00', '752000444'),
(17, 11, 0, 0, 'Pražská 2155/5', 'Praha', '120 00', '752000444'),
(18, 11, 0, 0, 'dsaf', 'fdaf', '4458', '721812230'),
(19, 11, 1, 0, 'dsaf', 'fdaf', '4458', '721812230'),
(20, 11, 0, 1, 'dsaf', 'fdaf', '4458', '721812230'),
(21, 11, 1, 0, 'dsaf', 'fdaf', '4458', '721812230'),
(22, 11, 0, 0, 'dsaf', 'fdaf', '4458', '721812230'),
(23, 11, 0, 0, 'Revoluční 93', 'Dobrovíz', '25261', '721812230'),
(24, 21, 0, 0, 'jfdakjlgqa', 'fdsafs', '20000', '7215415455'),
(25, 22, 0, 0, 'a', 'a', '10000', '13456789'),
(26, 22, 0, 0, '1', '1', '1', '11111111'),
(27, 23, 0, 0, 'Francouzska 3021', 'Praha', '12000', '722300200'),
(28, 19, 0, 0, 'a', 'a', '0', '123456789'),
(29, 24, 0, 0, 'sdsdsdsds', 'sdsdsds', 'dwdqewe', 'ýěěéééííí'),
(30, 19, 0, 0, 'Vostrovska', 'Praha', '16000', '607066252'),
(31, 19, 0, 0, 'Vostrovská', '-', '16000', '607066252'),
(32, 22, 0, 0, '1', '1', '1', '123456789'),
(33, 25, 0, 0, 'Revolucni 93', 'Dobroviz', '252 61', '721812230'),
(34, 25, 0, 0, 'Revolucni 93', 'Dobroviz', '252 61', '721812230');

-- --------------------------------------------------------

--
-- Struktura tabulky `USERS`
--

CREATE TABLE `USERS` (
  `USER_ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) DEFAULT NULL,
  `NAME` varchar(255) NOT NULL,
  `ROLE` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `EMAIL`, `PASSWORD`, `NAME`, `ROLE`) VALUES
(11, 'user@example.com', '$2y$10$Zwi8J/kNnn2MlN2XFya3GOz639GN0iD7Mc9P9bDC2Mkac38Z58gIC', 'John Doe', 0),
(15, 'kokot.tupej@mrdka.com', '$2y$10$HVgbhBi8kfVi5kVaJcWvduT1DLHUd0tjSzoCoiRA3qFIn.KtEyo0K', 'Kokot Tupej', 0),
(16, 'mrdka.hnusna@mrdka.com', '$2y$10$H8SGPCJq0EinkD4GX564Qeyp9PTw6OisrbyOw14y7.o.Xeja2O4xC', 'Mrdka Hnusna', 0),
(17, 'mrlogen1299@gmail.com', NULL, 'Vilém Charwot', 0),
(18, 'tadeas@email.cz', '$2y$10$1ePGbGDmlzSCoStGGNtPeOCwuZLyTEWnZVbM6tefyW2TF0W07ZfaC', 'Tadeas Charwot', 0),
(19, 'admin@example.com', '$2y$10$nTuy25v9QeaiioKhuVBYFuaXgAKk1jaI5LNXjCHbfkv3A4JeZl1Ta', 'Admin', 1),
(20, 'user2@example.com', '$2y$10$lWibOxN4SXMBa01.etzfgOSum.yDD8bJvr0JCpg.3sotVvNDUjOde', 'John Doe2', 0),
(21, 'user3@email.com', '$2y$10$VtHO96HEwnR19LuGKRFOzOtJ7jyVHPtwDk7edkUbU/VOHWOz4yirG', 'dsfdads', 0),
(22, 'nguv03@vse.cz', '$2y$10$D5INcxiBseFkILmUzuBeguy106FgerHWjkTFQk5arveJu4C2NI.ji', 'Testington Tesan', 0),
(23, 'random@gmail.com', '$2y$10$qIbwSzuMFSizznfVF14f4Ohjv3I/t80KS4ofJkmwqkQH8l0zkexZS', 'user33', 0),
(24, 'user00@gmail.com', '$2y$10$DYQiZ5wLlnQHbHbKeHMBE.h7iDdvPSntfvXa1.wrDoVCvDn1vjOZq', 'user', 0),
(25, 'chav07@vse.cz', '$2y$10$I6J04G2UTH47ayDWdDdKr.vV9KNHbAmSeG3F2ff604adkvNClEJiG', 'Vilem Charwot', 0);

-- --------------------------------------------------------

--
-- Struktura tabulky `USER_OAUTH_INFO`
--

CREATE TABLE `USER_OAUTH_INFO` (
  `INFO_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `OAUTH_PROVIDER` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `USER_OAUTH_INFO`
--

INSERT INTO `USER_OAUTH_INFO` (`INFO_ID`, `USER_ID`, `OAUTH_PROVIDER`) VALUES
(4, 17, 'facebook');

--
-- Indexy pro exportované tabulky
--

--
-- Indexy pro tabulku `AUTHORS`
--
ALTER TABLE `AUTHORS`
  ADD PRIMARY KEY (`ID_AUTHOR`);

--
-- Indexy pro tabulku `BOOKS`
--
ALTER TABLE `BOOKS`
  ADD PRIMARY KEY (`ID_BOOK`),
  ADD KEY `WROTE_FK` (`ID_AUTHOR`);

--
-- Indexy pro tabulku `HAS`
--
ALTER TABLE `HAS`
  ADD PRIMARY KEY (`ID_BOOK`,`ID_ORDER`),
  ADD KEY `HAS_FK` (`ID_BOOK`),
  ADD KEY `HAS2_FK` (`ID_ORDER`);

--
-- Indexy pro tabulku `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`ID_ORDER`),
  ADD KEY `CREATES_FK` (`USER_ID`);

--
-- Indexy pro tabulku `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Indexy pro tabulku `USER_OAUTH_INFO`
--
ALTER TABLE `USER_OAUTH_INFO`
  ADD PRIMARY KEY (`INFO_ID`),
  ADD KEY `FK_IS_AUTHENTICATED` (`USER_ID`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `AUTHORS`
--
ALTER TABLE `AUTHORS`
  MODIFY `ID_AUTHOR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pro tabulku `BOOKS`
--
ALTER TABLE `BOOKS`
  MODIFY `ID_BOOK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pro tabulku `HAS`
--
ALTER TABLE `HAS`
  MODIFY `ID_BOOK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pro tabulku `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `ID_ORDER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pro tabulku `USERS`
--
ALTER TABLE `USERS`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pro tabulku `USER_OAUTH_INFO`
--
ALTER TABLE `USER_OAUTH_INFO`
  MODIFY `INFO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `BOOKS`
--
ALTER TABLE `BOOKS`
  ADD CONSTRAINT `FK_WROTE` FOREIGN KEY (`ID_AUTHOR`) REFERENCES `AUTHORS` (`ID_AUTHOR`);

--
-- Omezení pro tabulku `HAS`
--
ALTER TABLE `HAS`
  ADD CONSTRAINT `FK_HAS` FOREIGN KEY (`ID_BOOK`) REFERENCES `BOOKS` (`ID_BOOK`),
  ADD CONSTRAINT `FK_HAS2` FOREIGN KEY (`ID_ORDER`) REFERENCES `ORDERS` (`ID_ORDER`);

--
-- Omezení pro tabulku `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `FK_CREATES` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`);

--
-- Omezení pro tabulku `USER_OAUTH_INFO`
--
ALTER TABLE `USER_OAUTH_INFO`
  ADD CONSTRAINT `FK_IS_AUTHENTICATED` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
