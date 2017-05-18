<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
**/
namespace GCore\Admin\Extensions\Chronoforums\Locales\SvSe;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Lang{
	const FORUM_ID_DOESNOT_EXIST = "Forum ID var inte med!";
	const UPDATE_SUCCESS = "Uppdatering Klar";
	const UPDATE_ERROR = "Uppdatering Misslyckades";
	const TOPIC_ID_DOESNOT_EXIST = "Inget ämnes-ID har angivits!";
	const MEMBERS_COUNT = "Antal Medlemmar";
	const TOPICS_COUNT = "Antal Ämnen";
	const POSTS_COUNT = "Antal Inlägg";
	const ATTACHMENTS_COUNT = "Antal Bilagor";
	const SAVE_SUCCESS = "Sparad";
	const SAVE_ERROR = "Det gick inte att spara";
	const CF_DB_TABLES_INSTALLED = "DB tabeller installerade.";
	const FORUMS_CATEGORY_NAME_REQUIRED = "Kategorirubrik Krävs";
	const FORUMS_FORUM_NAME_REQUIRED = "Forumrubrik Krävs";
	const FORUMS_POST_SUBJECT_REQUIRED = "Ämne krävs";
	const FORUMS_POST_TEXT_REQUIRED = "Text för inlägg krävs";
	const FORUMS_TOPIC_TITLE_REQUIRED = "Ämnesrubrik Krävs";
	const NEW_POSTS_AUTO_APPROVED = "Godkänn svar automatiskt";
	const NEW_POSTS_AUTO_APPROVED_DESC = "Nya svar kommer att automatiskt godkännas och kommer inte att behöva en moderators godkännande.";
	const AUTO_APPROVAL_THRESHOLD = "Min Inlägg för Autogodkännande";
	const AUTO_APPROVAL_THRESHOLD_DESC = "Auto godkänn nya inlägg eller svar från användarna om de redan har detta antal godkända inlägg.";
	const NON_APPROVED_THRESHOLD = "Max tillåtna ej godkännda inlägg";
	const NON_APPROVED_THRESHOLD_DESC = "Det maximala antalet icke godkända inlägg / ämnen som tillåts per användare, sätt till 0 för att inaktivera.";
	const NEVER = "Aldrig";
	const ALL_TIME = "Hela tiden";
	const ONLY_NOT_APPROVED = "Endast när inte godkänd";
	const APPLY = "Verkställ";
	const SAVE = "Spara";
	const CANCEL = "Avbryt";
	const GENERAL = "Generell";
	const CHRONOFORUMS_CATEGORY_ITEM_DETAILS = "Kategoridetaljer";
	const TITLE = "Rubrik";
	const ALIAS = "Alias";
	const DISPLAY = "Visa";
	const EMAIL_CONFIG = "E-postkonfiguration";
	const DESCRIPTION = "Beskrivning";
	const POSITION = "Position";
	const PUBLISHED = "Publicerad";
	const NO = "Nej";
	const YES = "Ja";
	const PERMISSIONS = "Behörigheter";
	const ALLOWED = "Tillåten";
	const INHERITED = "Ärvd";
	const NOT_SET = "Inte Inställd";
	const DENIED = "Nekad";
	const CATEGORIES_MANAGER = "Kategori Hanteraren";
	const HOME = "Hem";
	const CHRONOFORUMS_FORUM_ITEM_DETAILS = "Forumdetaljer";
	const CATEGORY = "Kategori";
	const FORUMS_MANAGER = "Forumhanteraren";
	const SETTINGS = "Inställningar";
	const VALIDATE_INSTALL = "Validera Installationen";
	const STATISTICS = "Statistik";
	const FOLDERS_PERMISSIONS = "Katalogbehörigheter";
	const SYNC = "Synkroniseringsstatus";
	const CPANEL_SYSINFO_DIR_NAME = "Katalognamn";
	const CPANEL_SYSINFO_DIR_STATUS = "Status";
	const CPANEL_SYSINFO_WRITABLE = "Skrivbar";
	const CPANEL_SYSINFO_NOT_WRITABLE = "Inte Skrivbar";
	const SYNC_FORUM = "Synkronisera Forumräknaren";
	const SYNC_FORUM_TOPICS = "Synkronisera Forumsämnesräknaren";
	const SYNC_TOPIC = "Synkronisera ämnesräknaren";
	const BOARD_SETTINGS = "Foruminställningar";
	const NOTIFICATIONS = "Meddelanden";
	const TEXT_EDITORS = "Text Editors";
	const BOARD_OFFLINE = "Forum Offline ?";
	const OFFLINE_MESSAGE = "Offline meddelande";
	const BOARD_THEME = "Tema";
	const ALLOWED_EXTENSIONS = "Tillåtna filnamn";
	const ALLOWED_EXTENSIONS_DESC = "Tillåtna filnamn för bilagor, t.ex. jpg-png-zip";
	const INLINE_EXTENSIONS = "Infogade Filer Filnamn";
	const INLINE_EXTENSIONS_DESC = "Filnamnsändelser för bilder som ska återges infogade, t.ex. jpg-png";
	const POSTS_LIMIT = "Antal inlägg per sida";
	const POSTS_LIMIT_DESC = "Det maximala antalet inlägg att visa på 1 sida";
	const TOPICS_LIMIT = "Antalet Ämnen per sida";
	const TOPICS_LIMIT_DESC = "Det maximala antalet ämnen att visa på 1 sida";
	const SEND_POST_EMAIL = "Skicka meddelande vid nytt inlägg.";
	const SEND_POST_EMAIL_DESC = "Skicka ett mejl när ett nytt svar görs?";
	const POSTS_NOTIFY_GROUPS = "Grupper som meddelas";
	const POSTS_NOTIFY_GROUPS_DESC = "De användargrupper som kommer att meddelas om alla nya svar som görs i forumen.";
	const TOPICS_ORDERING = "Ämnessortering";
	const POSTS_ORDERING = "Inläggssortering";
	const LINK_USERNAMES = "Länka Användarnamnet?";
	const DISPLAY_NAME = "Visa Namn";
	const USERNAME = "Användarnamn";
	const NAME = "Namn";
	const USERNAME_LINK_PATH = "Sökväg för Användarnamn";
	const USERNAME_LINK_PATH_DESC = "Sökvägen till användarnamnets länk du kan använda {id} för att ersätta med användarens id, lämna det tomt för att använda standardprofilsida.";
	const SHOW_DATETIME = "Visa aktuell tid";
	const DATE_TIMEZONE = "Datum - Tidzon";
	const NEW_TOPICS_AUTO_APPROVED = "Godkänn ämnen automatiskt";
	const NEW_TOPICS_AUTO_APPROVED_DESC = "Nya ämnen godkänns automatiskt och behöver inte att publiceras av en moderator.";
	const SEND_REPORT_EMAIL = "Skicka e-postrapport";
	const SEND_REPORT_EMAIL_DESC = "Skicka ett mejl när ett nytt inlägg är inlagt ?";
	const EMAIL_FROM_NAME = "Från Namn";
	const EMAIL_FROM_NAME_DESC = "Namnet som används i 'Från' fältet i mejlen som skickas från forumet till användarna.";
	const EMAIL_FROM_EMAIL = "Från e-post";
	const EMAIL_FROM_EMAIL_DESC = "E-postadressen som anger avsändaren i mejl från forumet till användarena.";
	const REPORTS_NOTIFY_GROUPS = "Grupper som får meddelanden";
	const REPORTS_NOTIFY_GROUPS_DESC = "Rapportmeddelanden kommer endast att skickas till dessa grupper.";
	const SEND_REPLY_EMAIL = "Skicka svarsmejl";
	const SEND_REPLY_EMAIL_DESC = "Skicka ett meddelande till användare som prenumererar på meddelanden när nya inlägg har gjorts i ämnet.";
	const SEND_TOPIC_EMAIL = "Skicka meddelande vid nytt ämne.";
	const SEND_TOPIC_EMAIL_DESC = "Skicka ett nytt meddelande när ett nytt ämne är postat?";
	const TOPICS_NOTIFY_GROUPS = "Grupper som meddelas vid nytt ämne";
	const TOPICS_NOTIFY_GROUPS_DESC = "Meddelandet kommer endast att skickas till dessa grupper.";
	const EDITORS_ADMIN_EDITOR = "Aktiv Editor";
	const EDITORS_FRONT_EDITOR = "Front Editor";
	const HIDE_NEW_TOPICS_BUTTON = "Dölj Nytt Inlägg";
	const HIDE_NEW_TOPICS_BUTTON_DESC = "Dölj Knappen Nytt Inlägg i det fall användaren inte har tillräcklig behörighet för att skapa nytt inlägg";
	const HIDE_POST_REPLY_BUTTON = "Dölj Skicka Svar";
	const HIDE_POST_REPLY_BUTTON_DESC = "Dölj Knappen Skicka Svar i det fall användaren inte har tillräcklig behörighet för att skicka ett svar";
	const USERS_RANKS = "Rankning";
	const RANK = "Rank";
	const RANK_ENABLED = "Aktiverad";
	const RANK_ENABLED_DESC = "Aktivera den här rankningen";
	const RANK_TITLE = "Rankningsrubrik";
	const RANK_TITLE_DESC = "En rubrik för din rankning";
	const RANK_POSTS = "Rankning av Inlägg";
	const RANK_POSTS_DESC = "Minsta antalet inlägg för en användare för att få den här rankningen";
	const RANK_GROUPS = "Rankning av Grupp(er)";
	const RANK_GROUPS_DESC = "Användare i den här gruppen är automatiskt kvalificerade för den här rankningen";
	const RANK_GROUP = "Rankning av Grupp ID";
	const RANK_GROUP_DESC = "ett grupp-ID för denna rank, för att associera flera ranks i en grupp, måste vara ett heltal, kommer 0 att betraktas som ingen grupp!";
	const RANK_WEIGHT = "Rankningsvikt";
	const RANK_WEIGHT_DESC = "Värdet för den här rankningen, rankning inom samma grupp ska ha olika värden, rankning med högre värde kommer att användas i stället för de med lägre värden, detta måste vara ett heltal.";
	const LOAD_RANKS = "Ladda Rankning";
	const LOAD_RANKS_DESC = "Ladda rankning när bearbetning av användarinfo görs.";
	const RANKS_SEPARATOR = "Separerare";
	const RANKS_SEPARATOR_DESC = "Strängen används för att skilja de olika ranks titlar / bilder";
	const RANK_CODE = "Rankningskod";
	const RANK_CODE_DESC = "PHP-kod (med PHP-taggar) som ska utföras varje gång användaren loggar in, om koden returnerar boolean sant då kommer användaren att få rankningen.";
	const RANK_OUTPUT = "Ranknings visning";
	const RANK_OUTPUT_DESC = "HTML-koden för att din rankning ska visas i stället för rankningsrubrik, du kan använda detta för att styla rankningstext eller använd bilder..etc";
	const RANK_NAME_COLOR = "Namnfärg";
	const RANK_NAME_COLOR_DESC = "Användare med denna rankning får sina användarnamn i den här färgen, observera att högre rankning kommer att prioriteras.";
	const FORUM_PERMISSIONS = "Forumbehörigheter";
	const FORUM_PERMISSIONS_DESC = "Aktivera Kategori/Forumbehörigheter, Om du aktivera detta vänligen se till att korrekt konfigurera behörigheter i forum/kategorisektionen.";
	const SPOOFING_LIMIT = "Inläggsbegränsning";
	const SPOOFING_LIMIT_DESC = "Minsta antalet sekunder mellan 2st efterföljande inlägg av samma användare, sätt till 0 för att inaktivera.";
	const SHOW_AUTHOR_POSTS_COUNT = "Visa räknare för inlägg";
	const SHOW_AUTHOR_POSTS_COUNT_DESC = "Visar författarens inläggs räknare i författarens avsnitt per post";
	const SHOW_AUTHOR_JOIN_DATE = "Visa anslutningsdatum";
	const SHOW_AUTHOR_JOIN_DATE_DESC = "Visar författarens Anslutningsdatum i författarens avsnitt per post";
	const SUPER_USERS_GROUPS = "Superanvändargrupper";
	const SUPER_USERS_GROUPS_DESC = "Grupper av super-användare som inte kan tas bort när du tar bort en författare";
	const AUTHORS = "Författare";
	const ALLOW_AUTHOR_DELETE = "Tillåt radering av författare";
	const ALLOW_AUTHOR_DELETE_DESC = "Tillåt moderatorer att radera författare inklusive alla deras inlägg och trådar";
	const ALLOW_QUOTE_REPLY = "Tillåt citat svar";
	const ALLOW_QUOTE_REPLY_DESC = "Tillåt användare att svara med att citera andra författares inlägg";
	const SEND_REPLY_CONTENT = "Skicka svarsinnehåll";
	const SEND_REPLY_CONTENT_DESC = "Ta med det nya svarets information i meddelandet detta inkluderar författarens användarnamn och meddelandetext.";
	const EMAILS_POSTING = "Mejlinställningar";
	const ENABLE_EMAILS_POSTING = "Aktivera";
	const ENABLE_EMAILS_POSTING_DESC = "Aktivera funktionen svara på e-postmeddelanden, användarna kan svara på inlägget genom att svara på det mejl som skickas ut då svar görs, PHP bör ha IMAP extension installerad och aktiverad.";
	const EMAIL_REPLY_EMAIL = "Forumets svarsadress";
	const EMAIL_REPLY_EMAIL_DESC = "Den e-postadress som användare kommer att svara via e-post, VARNING: alla meddelanden kommer att raderas efter skanning av dem, använd en speciell brevlåda för detta.";
	const EMAIL_REPLY_PASSWORD = "Lösenord för svarsadress";
	const EMAIL_REPLY_PASSWORD_DESC = "Lösenordet för e-postadressen för svar";
	const EMAIL_REPLY_PATH = "Svarsadress - sökväg";
	const EMAIL_REPLY_PATH_DESC = "Brevlådans sökväg för svarsadressen, Gmail:{imap.gmail.com:993/imap/ssl}INBOX, Yahoo:{imap.mail.yahoo.com:993/imap/ssl}INBOX, other:{SERVER_HERE:993/imap/ssl}INBOX";
	const EMAILS_POSTING_PERIOD = "Epost skanning";
	const EMAILS_POSTING_PERIOD_DESC = "Perioden (i minuter) som epostlådan kommer att skannas för nya mejl, skriv in ett heltal, du kan också skriva 0 för att inaktivera detta och använda ett cron-jobb på servern (bästa alternativet), cronjobbet ska pinga denna URL: index.php?option=com_chronoforums&cont=posts&act=email_reply";
	const EMAILS_POSTING_SECRET = "Hemligt ord";
	const EMAILS_POSTING_SECRET_DESC = "Skriv in ett hemligt ord som ska skickas med i webbadressen för att detta ska fungera, detta ska hindra utomstående från att försöka komma åt webbadressen själv, t.ex.: &secret=SECRET_WORD";
	const MIGRATE = "Forummigrering";
	const DELETE_CACHE = "Radera cache";
	const TAG_EXISTS = "Tagg finns redan!";
	const OCCURRENCES = "Förekomster";
	const OCCURRENCES_DESC = "Antalet förekomster av denna sträng inuti ett inlägg för att det ska kunna användas som en auto-tagg";
	const TAGS_MANAGER = "Tagghanterare";
	const TOPICS_TAGGED_SUCCESS = "Ämnet har taggats!";
	const ENABLE_FORUMS_DEBUG = "Forum Debug";
	const ENABLE_FORUMS_DEBUG_DESC = "Visar forumets debug data under den laddade sidan, detta inkluderar genereringstid, använt minne och db-förfrågningar";
	const ENABLE_FORUMS_VIEWS_CACHE = "Aktivera visningscache";
	const ENABLE_FORUMS_VIEWS_CACHE_DESC = "Aktivera forumets visningscache, detta kommer att cacha fullt genererade html-sidor av forumet.";
	const FORUMS_VIEWS_CACHE_TIME = "Visa cache tid";
	const FORUMS_VIEWS_CACHE_TIME_DESC = "Visa caching tid i sekunder.";
	const ENABLE_FORUMS_QUERY_CACHE = "Aktivera förfrågningscache";
	const ENABLE_FORUMS_QUERY_CACHE_DESC = "Kommer cache vissa frågeresultat, detta kan avsevärt förbättra prestanda för stora forum med tung trafik.";
	const FORUMS_QUERY_CACHE_TIME = "Frågecache tid";
	const FORUMS_QUERY_CACHE_TIME_DESC = "Frågecachingtiden i sekunder.";
	const ENABLE_TOPIC_VIEWS = "Aktivera ämnesvisningar";
	const ENABLE_TOPIC_VIEWS_DESC = "Öka ämnets visningsräknare när ämnet visas, och visa antalet visningar i ämneslistan.";
	const TOPIC_VIEWS_DISPLAY = "Utseende på räknaren för visningar";
	const TOPIC_VIEWS_DISPLAY_DESC = "Hur ska räknaren visas? antingen som en etikett under ämnesrubrik eller som en textkolumn.";
	const ENABLE_TOPIC_REPLIES = "Visa räknaren för svar";
	const ENABLE_TOPIC_REPLIES_DESC = "Visa räknaren för svar i ämneslistan.";
	const TOPIC_REPLIES_DISPLAY = "Utseende på svarsräknaren";
	const TOPIC_REPLIES_DISPLAY_DESC = "Hur ska räknaren visas? antingen som en etikett under ämnesrubrik eller som en textkolumn.";
	const FORUMS_CACHE_ENGINE = "Cachemotor";
	const FORUMS_CACHE_ENGINE_DESC = "Välj hur cachedata ska lagras, ändrar inte detta om du inte har den nya cache-motorn installerad och aktiverad på din webbserver.";
	const CFU_SEARCH = "Sök";
	const CFU_SYSTEM = "System";
	const CFU_STYLE = "Stil";
	const DEEP = "Djup";
	const TAGS = "Taggar";
	const TEXT = "Text";
	const LABEL = "Etikett";
	const SEND_POST_EDIT_EMAIL = "Mejl vid redigering av inlägg";
	const SEND_POST_EDIT_EMAIL_DESC = "Skicka ett mejlmeddelande när inlägg har redigerats ?";
	const POSTS_EDIT_NOTIFY_GROUPS = "Grupper att meddela";
	const POSTS_EDIT_NOTIFY_GROUPS_DESC = "Grupper som meddelas när inlägg har redigerats";
	const AUTOLOCK_TOPIC_INACTIVE_LIMIT = "Automatisk ämneslåsning";
	const AUTOLOCK_TOPIC_INACTIVE_LIMIT_DESC = "Antal dagar efter vilka ämnen kommer att automatiskt låses när användare försöker göra nya inlägg till dem, sätt till 0 för att inaktivera.";
	const SEARCH_METHOD = "Sökmetod";
	const SEARCH_METHOD_DESC = "Hur sökningen görs Detta påverkar alla / enstaka forum sökningar (i ämnes sökning är alltid djup), med djup menas att sökning sker i alla inläggens text vilket kanske inte alltid är det effektivaste sättet ibland.";
	const SAVE_SEARCH_TAGS = "Spara söktaggen";
	const SAVE_SEARCH_TAGS_DESC = "Auto extrahera nya taggar från användares sökningar";
	const UPDATE_TAGS_HITS = "Uppdatera taggsträffar";
	const UPDATE_TAGS_HITS_DESC = "Increment searched tags hits counter";
	const AUTO_TAG_TOPICS = "Autotagga ämnen";
	const AUTO_TAG_TOPICS_DESC = "Auto tilldela taggar till ämnen med varje nytt ämne eller inlägg som skapas.";
	const LIST_TOPIC_TAGS = "Lista ämnestaggar";
	const LIST_TOPIC_TAGS_DESC = "Lista de taggar asossierade med det öppnade ämnet under ämnets titel";
	const ENABLE_TOPIC_TAGS = "Aktivera ämnestaggar";
	const ENABLE_TOPIC_TAGS_DESC = "Enable tagging topics or showing the tags entry box or tags lists";
	const POSTS_FONT_SIZE = "Inläggens fontstorlek";
	const POSTS_FONT_SIZE_DESC = "Global fontstorlek för alla inläggens innehåll";
	const GLOBAL_CSS = "Global CSS";
	const GLOBAL_CSS_DESC = "Lägg till css-kod som ska laddas på alla forumsidor, detta kommer att åsidosätta alla stilar som finns inne i filerna och kommer inte att skrivas över när forumet uppdateras.";
	const ALLOW_USERS_AVATARS = "Tillåt avatarer";
	const ALLOW_USERS_AVATARS_DESC = "Tillåt användare att ladda upp sina avatarer i sina profiler";
	const SHOW_POST_AUTHOR_AVATAR = "Visa avatarer";
	const SHOW_POST_AUTHOR_AVATAR_DESC = "Visar författarens avatarbild inuti ämnessidan";
	const AVATAR_SIZE = "Avatarstorlek";
	const AVATAR_SIZE_DESC = "Maximalt tillåten storlek för avatarbild, i KB";
	const AVATAR_WIDTH = "Avatarbredd";
	const AVATAR_WIDTH_DESC = "Maximalt tillåtna bredd på avatarbild";
	const AVATAR_HEIGHT = "Avatarhöjd";
	const AVATAR_HEIGHT_DESC = "Maximalt tillåtna höjd på avatarbild";
	const DATE_TIMEZONE_DESC = "Ställ in förvald tid för forumet";
	const RANKS_MANAGER = "Rankningshanterare";
	const RT_SUPPORT = "Rockettheme support";
	const RT_SUPPORT_DESC = "Lägger till extra design stöd när du har något av de senaste Rocket mallar.";
	const TOPIC_POPULAR_LIMIT = "Begränsning för att visa ämnet som populärt";
	const TOPIC_POPULAR_LIMIT_DESC = "Det lägsta antalet visningar per ämne per dag för att ämnet ska vara Populärt";
	const TOPIC_HOT_LIMIT = "Begränsning för att visa ämnet som Hett";
	const TOPIC_HOT_LIMIT_DESC = "Det lägsta antalet inlägg per ämne för att ämnet ska vara Hett";
	const BOARD_DISPLAY = "Visning av Forumet";
	const BOARD_DISPLAY_DESC = "Välj den förvalda kategorivisningen eller visning av alla ämnen på forumets hemsida.";
	const CFU_DEFAULT = "Förvalt";
	const USERNAMES_AVATARS = "Användarnamnsavatar";
	const USERNAMES_AVATARS_DESC = "Visar en miniavatar bredvid användarnamnet ?";
	const POSTS_MINI_PROFILE = "Miniprofil";
	const POSTS_MINI_PROFILE_DESC = "Visar en miniprofil av författaren i varje inlägg?";
	const USERNAMES_MINI_PROFILE = "användarnamnspopup";
	const USERNAMES_MINI_PROFILE_DESC = "Laddar en minibild av användarinfo när muspekaren vilar på användarnamnet?";
	const ACTIVE_TOPIC_DAYS = "Aktivt ämne";
	const ACTIVE_TOPIC_DAYS_DESC = "Antal tidigare dagar då ämnet ska anses aktivt.";
	const EXTRA_INFO = "Extra info";
	const ENABLE_EXTRA_TOPIC_INFO = "Utökad ämnesinformation";
	const ENABLE_EXTRA_TOPIC_INFO_DESC = "Aktivera ämnes info , användarna kommer att kunna lägga till extra info när de skapar nya inlägg.";
	const EXTRA_TOPIC_INFO_CODE = "Ämne infokod";
	const EXTRA_TOPIC_INFO_CODE_DESC = "HTML-kod för dina extra ämnes fält, fält namn ska vara i detta format: topic_info[name], e.g: topic_info[version]";
	const EXTRA_TOPIC_INFO_OUTPUT = "Visning av ämnesinfo";
	const EXTRA_TOPIC_INFO_OUTPUT_DESC = "Koden för att visa ämnets info, använder klammerparantes för att visa fält information, t.ex.: {topic_info.version}";
	const DISCUSSIONS = "Diskussioner";
	const FORUMS_FORUM_REQUIRED = "Välj ett Forum";
	const FORUM_ICON = "Forumikon";
	const QUICK_POST_TOOLS = "Snabba inlägg - verktyg";
	const QUICK_POST_TOOLS_DESC = "När funktionen är aktiverad, kommer det att visa en lista med ikoner för snabba inlägg i stället för en lista med länkar.";
	const DISPLAY_FORUM_ICON = "Visa Forumikon";
	const DISPLAY_FORUM_ICON_DESC = "Visar Forumets ikoner på forumets hemsida?";
	const PRIVATE_MESSAGES = "Privata meddelanden";
	const ENABLE_PRIVATE_MESSAGES = "Aktivera PM";
	const ENABLE_PRIVATE_MESSAGES_DESC = "Aktivera privata meddelanden mellan användarna.";
	const ENABLE_MESSAGE_NOTIFY = "Aktivera notifikationer";
	const ENABLE_MESSAGE_NOTIFY_DESC = "Skicka ett mail till mottagaren vid mottagandet av ett nytt privat meddelande?";
	const ENABLE_MESSAGES_GROUPS_FILTER = "Gruppfiltrering";
	const ENABLE_MESSAGES_GROUPS_FILTER_DESC = "Aktivera ett filter på de grupper som får ta emot privata meddelanden.";
	const MESSAGES_ALLOWED_GROUPS = "PM tillåtna grupper";
	const MESSAGES_ALLOWED_GROUPS_DESC = "Grupper som är tillåtna för att ta emot meddelanden.";
	const POSTS_ORDERING_EARLIEST_FIRST = "Inläggsdatum - nyaste först";
	const POSTS_ORDERING_LATEST_FIRST = "Inläggsdatum - senaste först";
	const ENABLE_TOPICS_TRACK = "Aktivera Ämnet läst";
	const ENABLE_TOPICS_TRACK_FRONT_DESC = "Spåra de lästa ämnenas status.";
	const ENABLE_TOPICS_TRACK_DESC = "Aktivera spåra ämnen som lästs status, när denna inställning är aktiverad, kommer användarna att kunna aktivera ämnen som lästs status i forumets inställningar.";
	const REPLACER = "Ersättare";
	const SEARCH_FLOODING_LIMIT = "Inläggspostnings gräns";
	const SEARCH_FLOODING_LIMIT_DESC = "Det antal i sekunder under vilken samma användare inte kan utföra mer än 1 sökning.";
	const AUTO_REPLY = "Autosvar";
	const AUTO_REPLY_SECURITY_TOKEN = "Säkerhetstecken";
	const AUTO_REPLY_SECURITY_TOKEN_DESC = "Säkerhetssträng för att skydda autosvars url från publik åtkomst.";
	const AUTO_REPLY_CONTENT = "Svarsinnehåll";
	const AUTO_REPLY_CONTENT_DESC = "Innehållet i autosvar, du kan använda PHP, om inget innehåll returneras då kommer inget svar att göras, du kan komma åt Inläggens ämne och text under: \$this->data['title'] or ['text']";
	const ENABLE_AUTO_REPLY = "Aktivera autosvar";
	const ENABLE_AUTO_REPLY_DESC = "Efter att ett nytt ämne startats kommer den automatiska svarstjänsten att analysera det första inläggets text och bearbeta koden nedan för att göra en autosvar.";
	const AUTO_REPLY_USER_ID = "Användar id";
	const AUTO_REPLY_USER_ID_DESC = "Det användarnamn för kontot som används för att göra auto svar.";
	const SEARCH_WORDS_LIMIT = "Ordbegränsning";
	const SEARCH_WORDS_LIMIT_DESC = "Begränsa antalet sökord, höga siffror kan orsaka problem med stora forum.";
	const SEARCH_START_FROM = "Start från alternativ";
	const SEARCH_START_FROM_DESC = "De alternativ som finns i starten från rullgardinsmenyn i sök config, bara skriv numret + tecknet som representerar tids perdiod, t.ex.: 1y för '1 År'eller 3m för '3 månader' eller 1v för '1 vecka'";
	const SEARCH_START_FROM_VALUE = "Förvalt värde";
	const SEARCH_START_FROM_VALUE_DESC = "Ett av de värden som anges ovan att välja för att använda som standard.";
	const ENABLE_TOPICS_FAVORITES = "Aktivera favoriter";
	const ENABLE_TOPICS_FAVORITES_DESC = "Aktivera favoritämnes funktionen, användarna kommer då att kunna lägga till ämnena till sin favoritlista.";
	const AUTHOR_DELETE_AFFECTED_TOPICS_LIMIT = "Författarradering begränsas av antal inlägg";
	const AUTHOR_DELETE_AFFECTED_TOPICS_LIMIT_DESC = "Det antal inlägg som begränsar att användaren inte kan raderas, ställ in detta på ett lågt värde för att skydda dig från att ta bort felaktiga konton.";
	const AUTHOR_DELETE_CODE_CHECK = "Författarradering kontrollkod";
	const AUTHOR_DELETE_CODE_CHECK_DESC = "Kör denna kod innan användaren tas bort, om den returnerar boolean false då kommer inte raderingen att fungera, användbart om du behöver kontrollera vissa användardata, har $ author_id variabeln har id för användaren som ska tas bort.";
	const RELEVANCE = "Relevans";
	const DEEP_SEARCH_TYPE = "Utökad sökning typ";
	const DEEP_SEARCH_TYPE_DESC = "Fråge typ som används för utökad (FULLTEXT) sökning.";
	const SEARCH_ORDER = "Sökordning";
	const SEARCH_ORDER_DESC = "Den ordning som används för att visa sökresultat.";
	const ENABLE_QUICK_REPLY = "Snabbsvar";
	const ENABLE_QUICK_REPLY_DESC = "Aktivera snabbsvars funktionen, det kommer då att visas ett enkelt snabbsvars formulär nedanför listan över ämnen.";
	const CFU_LANGUAGES = "Språk";
	const CFU_LANGUAGES_DESC = "Kommaseparerad lista med språktaggar, kategorin kommer att döljas för användarna som besöker forumet under ett annat aktivt språk, till exempel: fr-FR, sv-SE";
	const ENABLE_TOPICS_FEATURED = "Utvalda Ämnen";
	const ENABLE_TOPICS_FEATURED_DESC = "Aktivera listan för utvalda ämnen och knappar.";
	const ENABLE_MINI_PAGER = "Mini sidvisning";
	const ENABLE_MINI_PAGER_DESC = "Aktivera mini sidnumrering för ämnen i ämnessidorna.";
	const ENABLE_VOTES = "Aktivera röstning";
	const ENABLE_VOTES_DESC = "Tillåt att Forumanvändare kan rösta på inlägg/Ämnen.";
	const ENABLE_DOWN_VOTES = "Aktivera negativ röstning";
	const ENABLE_DOWN_VOTES_DESC = "Ska användarna kunna rösta negativt på inlägget?";
	const ENABLE_REPUTATION = "Aktivera Karma";
	const ENABLE_REPUTATION_DESC = "Beräkna och lagra karmapoäng för varje användare.";
	const VOTE_REPUTATION_WEIGTH = "Röstens värde";
	const VOTE_REPUTATION_WEIGTH_DESC = "Det värde på karmat som ges till användaren när deras inlägg får en upp eller ned röst";
	const POST_REPUTATION_WEIGTH = "Inläggskarma";
	const POST_REPUTATION_WEIGTH_DESC = "Det värde på karmat som ges till användaren när dom gör ett svarsinlägg.";
	const TOPIC_REPUTATION_WEIGTH = "Ämneskarma";
	const TOPIC_REPUTATION_WEIGTH_DESC = "Det värde på karmat som ges till användaren när dom gör ett ämnesinlägg.";
	const ANSWER_REPUTATION_WEIGTH = "Svarskarma";
	const ANSWER_REPUTATION_WEIGTH_DESC = "Det värde på karmat som ges till användaren när deras inlägg får Bästa svar.";
	const POST_TITLE_AUTHOR = "Visa författare för inlägg";
	const POST_TITLE_AUTHOR_DESC = "Visa författarens användarnamn / avatar i inläggets rubrik";
	const ENABLE_COMMUNITY_SUPPORT = "Community support ?";
	const ENABLE_COMMUNITY_SUPPORT_DESC = "Synka forumsdata med ChronoCommunity? Du måste ha ChronoCommunity installerat.";
	const TOPIC_SUBSCRIBE_ENABLED = "Aktivera ämnesprenumeration";
	const TOPIC_SUBSCRIBE_ENABLED_DESC = "Detta kommer att automatiskt att göra användare till prenumererant på ämnet när han använder snabbsvaret, och kommer automatiskt att aktivera kryssrutan på sidorna svara och nya ämnen.";
	const ENABLE_SMTP = "Aktivera SMTP";
	const SMTP_SECURE = "SMTP Säkerhet";
	const SMTP_SECURE_DESC = "SMTP säkerhetsmodell för din server, i förekommande fall, oftast ssl eller tls, det värde som används är SKIFTLÄGESKÄNSLIGT, det är oftast små bokstäver, t.ex.: tls, men INTE TLS";
	const SMTP_HOST = "SMTP värdnamn";
	const SMTP_PORT = "SMTP Port";
	const SMTP_USERNAME = "SMTP användarnamn";
	const SMTP_PASSWORD = "SMTP lösenord";
	const INLINE_IMAGES_DISPLAY = "Hur skall bilder visas";
	const INLINE_IMAGES_DISPLAY_DESC = "Välj om du vill att infogade bilder ska förstoras eller utökas för mer information.";
	const ENLARGABLE = "Expanderade";
	const MAGNIFIED = "Förstorade";
	const MODAL = "Modal popupp";
	const AUTO_COLLAPSE_CODE = "Kod för auto kollaps";
	const AUTO_COLLAPSE_CODE_DESC = "Ladda kodområden i inlägg kollapsade som standard, om detta är aktiverat kommer en länk att visas ovanför kodområdet för att tillåta användaren att utöka rutan lätt.";
	const USER_DIRECTORY_FILES = "Användarregisterfiler";
	const USER_DIRECTORY_FILES_DESC = "Spara bifogade filer inom kataloger som matchar uppladdande användarens id, denna inställning bör göras innan forumet används, om detta görs senare är det din uppgift att flytta filerna mellan mapparna.";
	const PERMISSIONS_LEGEND = "Behörighetstext";
	const ALLOWED_DESC = "Tillåt denna grupp och ALLA UNDERGRUPPER att utföra den valda åtgärden, förutsatt att undergrupperna är inställda på 'ärvd'.";
	const INHERITED_DESC = "Ställ inte in särskilda behörigheter, utan ärv inställningen från den överordnade gruppen.";
	const NOT_SET_DESC = "Tiilåt inte denna grupp att göra den valda åtgärden, detta påverkar inte undergrupper, även om de är inställda på 'ärvd'.";
	const DENIED_DESC = "Tillåt inte denna grupp och ALLA UNDERGRUPPER från att utföra den valda åtgärden, oberoende av behörighetsinställningen, vare sig dom är inställda på 'tillåt' eller 'ärvd'.";
	const LOAD_FORUMS_LIST = "LAdda forumlistan";
	const LOAD_FORUMS_LIST_DESC = "Ladda forumlistan under varje kategori på forumets startsida, ställ in detta till nej om du vill att forumet ska visas först efter att användaren går in i en viss kategori.";
	const POSTS_LOADER_ENABLED = "Aktivera ladda inlägg";
	const POSTS_LOADER_ENABLED_DESC = "Aktiveraladda inlägg på trådsidor, användarna kommer att kunna ladda fler inlägg utan att ändra sidan, ifall ämnet har mer än 1 sida med inlägg.";
	const POSTS_LOADER_METHOD = "Laddningsmetod";
	const POSTS_LOADER_METHOD_DESC = "Du kan använda en ladda fler knapp eller ladda inlägg automatiskt när användaren rullar nära till slutet av sidan.";
	const POSTS_LOADER_LIMIT = "Laddningsbegränsning";
	const POSTS_LOADER_LIMIT_DESC = "Antalet inlägg som ska laddas varje gång då en knapptryckning görs eller vid rullning mot sidslutet.";
	const POSTS_LOADER_SCROLL_DISTANCE = "Rullningsdistans";
	const POSTS_LOADER_SCROLL_DISTANCE_DESC = "Minsta avståndet (i px) som användaren måste vara från slutet av listan med inlägg innan den automatiskt visar fler inlägg.";
	const POSTS_LOADER = "Laddning av inlägg";
	const SCROLL = "Rullning";
	const BUTTON = "Knapp";
	const ENABLE_TOPIC_PREVIEW = "Förhandsvisa ämnen";
	const ENABLE_TOPIC_PREVIEW_DESC = "Aktivera förhandsvisning av inlägg på sidan svara på inlägg?";
}