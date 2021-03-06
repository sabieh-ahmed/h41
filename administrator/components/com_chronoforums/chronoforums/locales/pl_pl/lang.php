<?php
/**
* ChronoCMS version 1.0
* Copyright (c) 2012 ChronoCMS.com, All rights reserved.
* Author: (ChronoCMS.com Team)
* license: Please read LICENSE.txt
* Visit http://www.ChronoCMS.com for regular updates and information.
* polish translation by Jerzy (juwicz@gmail.com)
**/
namespace GCore\Admin\Extensions\Chronoforums\Locales\PlPl;
/* @copyright:ChronoEngine.com @license:GPLv2 */defined('_JEXEC') or die('Restricted access');
defined("GCORE_SITE") or die;
class Lang {
	const FORUM_ID_DOESNOT_EXIST = "Brak/nieznany identyfikator forum (Forum ID)!";
	const UPDATE_SUCCESS = "Aktualizacja udana";
	const UPDATE_ERROR = "Aktualizacja nie powiodła się";	
	const TOPIC_ID_DOESNOT_EXIST = "Brak/nieznany identyfikator tematu (Topic ID)!";
	const MEMBERS_COUNT = "liczba członków";
	const TOPICS_COUNT = "tematy";
	const POSTS_COUNT = "liczba wpisów";
	const ATTACHMENTS_COUNT = "liczba załączników";    
	const SAVE_SUCCESS = "Zapisano";
	const SAVE_ERROR = "Zapisywanie nie powiodło się";
	const CF_DB_TABLES_INSTALLED = "Tabele bazy danych zostały zainstalowane.";
	const FORUMS_CATEGORY_NAME_REQUIRED = "Wymagana nazwa kategorii";
	const FORUMS_FORUM_NAME_REQUIRED = "Wymagana nazwa forum";
	const FORUMS_POST_SUBJECT_REQUIRED = "Wymagany tytuł wpisu";
	const FORUMS_POST_TEXT_REQUIRED = "Wymagany tekst wpisu";
	const FORUMS_TOPIC_TITLE_REQUIRED = "Wymagany tytuł tematu";
	const NEW_POSTS_AUTO_APPROVED = "Autoakceptacja wpisów";
	const NEW_POSTS_AUTO_APPROVED_DESC = "nowe wpisy będą automatycznie akceptowane i nie będą wymagały akceptacji moderatora.";
	const AUTO_APPROVAL_THRESHOLD = "Próg autoakceptacji";
	const AUTO_APPROVAL_THRESHOLD_DESC = "autoakceptacja nowych tematów lub wpisów użytkowników, jeśli osiągnęli tę liczbę zaakceptowanych wpisów.";
	const NON_APPROVED_THRESHOLD = "Próg braku akceptacji";
	const NON_APPROVED_THRESHOLD_DESC = "maksymalna liczba niezaakcaptowanych wpisów/tematów dozwolonych dla użytkownika, ustaw 0 by wyłączyć.";
	const NEVER = "Nigdy";
	const ALL_TIME = "Zawsze";
	const ONLY_NOT_APPROVED = "Tylko gdy brak akceptacji";	
    const APPLY = "zastosuj";
	const SAVE = "zapisz";
	const CANCEL = "anuluj";
	const GENERAL = "ogólne";
	const CHRONOFORUMS_CATEGORY_ITEM_DETAILS = "Szczegóły kategorii";
	const TITLE = "tytuł";
	const ALIAS = "alias";
	const DISPLAY = "wyświetlanie";
	const EMAIL_CONFIG = "poczta elektroniczna";
	const DESCRIPTION = "opis";
	const POSITION = "pozycja";
	const PUBLISHED = "opublikowane";
	const NO = "nie";
	const YES = "tak";
	const PERMISSIONS = "uprawnienia";
	const ALLOWED = "dozwolone";
	const INHERITED = "dziedziczone";
	const NOT_SET = "nie ustawione";
	const DENIED = "brak dostępu";
	const CATEGORIES_MANAGER = "zarządzanie kategoriami";
	const HOME = "menu główne";
	const CHRONOFORUMS_FORUM_ITEM_DETAILS = "Szczegóły forum";
	const CATEGORY = "kategoria";
	const FORUMS_MANAGER = "zarządzanie forami";
	const SETTINGS = "opcje";
	const VALIDATE_INSTALL = "legalizacja instalacji";
	const STATISTICS = "statystyka";
	const FOLDERS_PERMISSIONS = "uprawnienia do katalogów";
	const SYNC = "synchronizacja stanu";
	const CPANEL_SYSINFO_DIR_NAME = "Nazwa katalogu";
	const CPANEL_SYSINFO_DIR_STATUS = "Status";
	const CPANEL_SYSINFO_WRITABLE = "zapisywalny";
	const CPANEL_SYSINFO_NOT_WRITABLE = "niezapisywalny";
	const SYNC_FORUM = "Synch. liczniki forum";
	const SYNC_FORUM_TOPICS = "Synch. liczniki postów w forum";
	const SYNC_TOPIC = "Synch liczniki postów";	
	const BOARD_SETTINGS = "Konfiguracja forum";
	const NOTIFICATIONS = "powiadomienia";
	const TEXT_EDITORS = "edytory tekstu";
	const BOARD_OFFLINE = "Forum wyłączone ?";
	const OFFLINE_MESSAGE = "Komunikat dla wyłączonego forum";
	const BOARD_THEME = "Wygląd";
	const ALLOWED_EXTENSIONS = "Akceptowane pliki";
	const ALLOWED_EXTENSIONS_DESC = "akceptowane rozszerzenia przesyłanych załączników, np: jpg-png-zip";
	const INLINE_EXTENSIONS = "Obrazy wstawiane w treść";
	const INLINE_EXTENSIONS_DESC = "rozszerzenia plików graficznych umieszczanych bezpośrednio w treści, tzn: jpg-png";
	const POSTS_LIMIT = "Limit wpisów";
	const POSTS_LIMIT_DESC = "maksymalna liczba wpisów wyświetlanych na jednej stronie";
	const TOPICS_LIMIT = "Limit tematów";
	const TOPICS_LIMIT_DESC = "maksymalna liczba tematów wyświetlanych na jednej stronie";
	const SEND_POST_EMAIL = "Wysyłanie powiadomień o nowych wpisach.";
	const SEND_POST_EMAIL_DESC = "czy wysyłać email gdy zostanie dodany nowy wpis ?";
	const POSTS_NOTIFY_GROUPS = "Grupy powiadamiane o wpisach";
	const POSTS_NOTIFY_GROUPS_DESC = "grupy użytkowników, które będą otrzymywać powiadomienia o dodaniu dowolnego nowego wpisu na forum.";
	const TOPICS_ORDERING = "Sortowanie tematów";
	const POSTS_ORDERING = "Sortowanie wpisów";
	const LINK_USERNAMES = "Nazwy użytkowników odnośnikami?";
	const DISPLAY_NAME = "Nazwa wyświetlana";
	const USERNAME = "nazwa użytkownika";
	const NAME = "nazwisko";
	const USERNAME_LINK_PATH = "Odnośnik dla nazwy użytkownika";
	const USERNAME_LINK_PATH_DESC = "ścieżka odnośnika dla nazwy użytkownika, można użyć {id} w celu zastąpienia przez identyfikator użytkownika";
	const SHOW_DATETIME = "Wyświetl aktualny czas";
	const DATE_TIMEZONE = "Strefa czasowa";
	const NEW_TOPICS_AUTO_APPROVED = "Autoakceptacja nowych tematów";
	const NEW_TOPICS_AUTO_APPROVED_DESC = "nowe tematy są automatycznie zaakceptowane i nie wymagają publikacji przez moderatora.";
	const SEND_REPORT_EMAIL = "Wysyłanie zgłoszeń";
	const SEND_REPORT_EMAIL_DESC = "wyślij wiadomość e-mail, gdy wpis został zgłoszony";
	const EMAIL_FROM_NAME = "Nadawca";
	const EMAIL_FROM_NAME_DESC = "Nazwa używana w wiadomościach poczty elektronicznej wysyłanych z forum do członków.";
	const EMAIL_FROM_EMAIL = "Adres nadawcy";
	const EMAIL_FROM_EMAIL_DESC = "adres poczty elektronicznej używanej w wiadomościach wysyłanych z forum do członków.";
	const REPORTS_NOTIFY_GROUPS = "Powiadom grupy";
	const REPORTS_NOTIFY_GROUPS_DESC = "powiadomienia o zgłoszeniach będą wysyłane wyłącznie do powyższych grup";
	const SEND_REPLY_EMAIL = "Wiad. o odpowiedzi";
	const SEND_REPLY_EMAIL_DESC = "wyślij maila powiadamiającego użytkowników mających wpisy w temacie X o nowym wpisie";
	const SEND_TOPIC_EMAIL = "Wiad. o nowym temacie";
	const SEND_TOPIC_EMAIL_DESC = "wyślij maila, gdy pojawi się nowy temat";
	const TOPICS_NOTIFY_GROUPS = "Powiadom grupy";
	const TOPICS_NOTIFY_GROUPS_DESC = "powiadomienia o nowym temacie wysyłane będą wyłącznie do powyższych grup";
	const EDITORS_ADMIN_EDITOR = "Aktywny edytor";
	const EDITORS_FRONT_EDITOR = "Edytor użytkownika";
	const HIDE_NEW_TOPICS_BUTTON = "Ukryj Nowy temat";
	const HIDE_NEW_TOPICS_BUTTON_DESC = "ukryj przycisk Nowy temat w przypadku, gdy użytkownik nie ma dostatecznych uprawnień do napisania nowego tematu";
	const HIDE_POST_REPLY_BUTTON = "Ukryj Odpowiedz";
	const HIDE_POST_REPLY_BUTTON_DESC = "ukryj przycisk Odpowiedz w przypadku, gdy użytkownik nie ma dostatecznych uprawnień do zamieszczenia odpowiedzi";
	const USERS_RANKS = "rangi";
	const RANK = "Ranga";
	const RANK_ENABLED = "Włączona";
	const RANK_ENABLED_DESC = "włącz tę rangę";
	const RANK_TITLE = "Nazwa rangi";
	const RANK_TITLE_DESC = "tytuł rangi";
	const RANK_POSTS = "Limit wpisów";
	const RANK_POSTS_DESC = "minimalna liczba wpisów użytkownika niezbędna do otrzymania tej rangi";
	const RANK_GROUPS = "Grupy";
	const RANK_GROUPS_DESC = "użytkownicy tych grup będą automatycznie otrzymywać tę rangę";
	const RANK_GROUP = "Identyfikator grupowy";
	const RANK_GROUP_DESC = "identyfikator grupowy dla tej rangi, do łączenia kilku rang w jedną grupę, identyfikator musi być liczbą całkowitą";
	const RANK_WEIGHT = "Waga rangi";
	const RANK_WEIGHT_DESC = "wartość wagi dla rangi, rangi z jednej grupy powinny mieć różne wagi, ranga z wyższą wagą będzie używana w zamian rangi o niższej wadze, waga musi być liczbą całkowitą";
	const LOAD_RANKS = "Wyliczanie rangi";
	const LOAD_RANKS_DESC = "wylicz i pokaż rangę podczas przetwarzania danych użytkownika";
	const RANKS_SEPARATOR = "Separator";
	const RANKS_SEPARATOR_DESC = "ciąg znaków używany do rozdzielania różnych tytułów/grafik rang";
	const RANK_CODE = "Kod dla rangi";
	const RANK_CODE_DESC = "kod PHP dla rangi, który będzie uruchamiany przy każdym logowaniu użytkownika, jeśli kod zwróci PRAWDĘ, to użytkownikowi zostanie przydzielona ranga";
	const RANK_OUTPUT = "Wyświetlanie rangi";
	const RANK_OUTPUT_DESC = "kod HTML dla rangi, który będzie wyświetlany zamiast tytułu rangi, możesz użyć do nadania stylu randze tekstowej lub do użycia grafiki itp.";
	const RANK_NAME_COLOR = "Kolor nazwy";
	const RANK_NAME_COLOR_DESC = "użytkownicy o tej randze będą mieli wyświetlane swoje nazwy w tym kolorze, pamiętaj, że rangi z wyższą wagą mają priorytet.";
	const FORUM_PERMISSIONS = "Uprawnienia na forum";
	const FORUM_PERMISSIONS_DESC = "włącza uprawnienia dla kategorii/forum, jeśli włączysz tę opcję, to upewnij się, że prawidłowo zostały skonfigurowane  uprawnień w sekcji forum/kategorii";
	const SPOOFING_LIMIT = "Ogranicznik częstości wpisów";
	const SPOOFING_LIMIT_DESC = "minimalna liczba sekund pomiędzy dwoma wpisami tego samego użytkownika, wpisz 0 by wyłączyć";
	const SHOW_AUTHOR_POSTS_COUNT = "Wyświetl liczbę wpisów";
	const SHOW_AUTHOR_POSTS_COUNT_DESC = "wyświetlanie liczby wpisów zamieszczonych przez użytkownika";
	const SHOW_AUTHOR_JOIN_DATE = "Wyświetl datę rejestracji";
	const SHOW_AUTHOR_JOIN_DATE_DESC = "wyświetlanie daty zarejestrowania użytkownika na forum";
	const SUPER_USERS_GROUPS = "Grupy super użytkowników";
	const SUPER_USERS_GROUPS_DESC = "grupy użytkowników (super użytkowników), którzy nie będą usunięci poleceniem usuwania autora";
	const AUTHORS = "autorzy";
	const ALLOW_AUTHOR_DELETE = "Zezwól na usunięcie autorów";
	const ALLOW_AUTHOR_DELETE_DESC = "zezwolenie moderatorom na usunięcie autorów włącznie z ich wpisami i tematami";
	const ALLOW_QUOTE_REPLY = "Zezwól na odpowiedzi z cytowaniem";
	const ALLOW_QUOTE_REPLY_DESC = "zezwolenie użytkownikom na odpowiedzi z cytowaniem wpisów innych autorów";
	const SEND_REPLY_CONTENT = "Wysyłanie treści odpowiedzi";
	const SEND_REPLY_CONTENT_DESC = "dołączanie informacji o nowej odpowiedzi w powiadomieniu, dotyczy nazwy autora i treści wpisu.";
	const EMAILS_POSTING = "wpisy via email";
	const ENABLE_EMAILS_POSTING = "Włączone";
	const ENABLE_EMAILS_POSTING_DESC = "włącza opcję zamieszczania wpisów poprzez wysłanie mail'a, użytkownik może zamieścić wpis (odpowiedź) poprzez odpowiedź na maila o nowym wpisie, PHP musi mieć zainstalowane i włączone rozszerzenie IMAP.";
	const EMAIL_REPLY_EMAIL = "Adres dla odpowiedzi forum";
	const EMAIL_REPLY_EMAIL_DESC = "adres email, na który będą przysyłane odpowiedzi użytkowników (wpisy via email), UWAGA: wszystkie wiadomości będą usuwane po przetworzeniu, proszę przewidzieć osobną skrzynkę pocztową na tę usługę.";
	const EMAIL_REPLY_PASSWORD = "Hasło dla adresu odpowiedzi";
	const EMAIL_REPLY_PASSWORD_DESC = "hasło dla adresu wpisów via email";
	const EMAIL_REPLY_PATH = "Ścieżka adresu wpisów";
	const EMAIL_REPLY_PATH_DESC = "The mailbox path for the reply address provided, Gmail:{imap.gmail.com:993/imap/ssl}INBOX, Yahoo:{imap.mail.yahoo.com:993/imap/ssl}INBOX, other:{SERVER_HERE:993/imap/ssl}INBOX";
	const EMAILS_POSTING_PERIOD = "Odstęp pobierania poczty";
	const EMAILS_POSTING_PERIOD_DESC = "czas (w minutach), co jaki będzie sprawdzana skrzynka pocztowa na okoliczność nowych wiadomości, proszę wpisać liczbę całkowitą, można wpisać 0 by wyłączyć sprawdzanie i użyć procesu demona na serwerze (zalecane), damon powinien uruchamiać polecenie ping z następującym url: index.php?option=com_chronoforums&cont=posts&act=email_reply";
	const EMAILS_POSTING_SECRET = "Tajne słowo";
	const EMAILS_POSTING_SECRET_DESC = "Enter a secret word to be passed in the url for it to work, this should stop any outsiders from trying to access the url themselves, e.g: &secret=SECRET_WORD";
	const MIGRATE = "migruj dane";
	const DELETE_CACHE = "oczyść pamięć podręczną";
	const TAG_EXISTS = "Etykieta już istnieje!";
	const OCCURRENCES = "Wystąpienia";
	const OCCURRENCES_DESC = "liczba wystąpień słowa we wpisie, aby zostało dodane jako automatyczna etykieta dla wpisu";
	const TAGS_MANAGER = "zarządzanie etykietami";
	const TOPICS_TAGGED_SUCCESS = "Dodano etykietę do tematu!";
	const ENABLE_FORUMS_DEBUG = "Debugowanie forum";
	const ENABLE_FORUMS_DEBUG_DESC = "wyświetla poniżej załadowanej strony dane służące do debugowania forum, w tym czas wygenerowania, użytą pamięć i zapytania do bazy danych";
	const ENABLE_FORUMS_VIEWS_CACHE = "Włącz pamięć podręczną dla stron";
	const ENABLE_FORUMS_VIEWS_CACHE_DESC = "włącza pamięć podręczną dla stron forum, wygenerowane strony HTML forum będą przechowywane w pamięci podręcznej.";
	const FORUMS_VIEWS_CACHE_TIME = "Czas życia stron";
	const FORUMS_VIEWS_CACHE_TIME_DESC = "czas przechowywania stron w pamięci podręcznej, w sekundach.";
	const ENABLE_FORUMS_QUERY_CACHE = "Włącz pamięć podręczną dla zapytań";
	const ENABLE_FORUMS_QUERY_CACHE_DESC = "przechowuje w pamięci podręcznej wyniki niektórych zapytań, co może zdecydowanie poprawić wydajność dla dużych for z dużą liczbą odwiedzających.";
	const FORUMS_QUERY_CACHE_TIME = "Czas życia wyników zapytań";
	const FORUMS_QUERY_CACHE_TIME_DESC = "czas przechowywania wyników zapytań w pamięci podręcznej, w sekundach.";
	const ENABLE_TOPIC_VIEWS = "Licznik odsłon tematu";
	const ENABLE_TOPIC_VIEWS_DESC = "licznik odsłon tematu będzie zwiększany przy każdym wyświetleniu danego tematu i będzie wyświetlany na liście tematów.";
	const TOPIC_VIEWS_DISPLAY = "Wyświetlanie licznika odsłon";
	const TOPIC_VIEWS_DISPLAY_DESC = "jak wyświetlać licznik odczytów: jako etykietę poniżej tytułu tematu czy jako kolumnę tekstową?";
	const ENABLE_TOPIC_REPLIES = "Wyświetlać licznik odpowiedzi?";
	const ENABLE_TOPIC_REPLIES_DESC = "czy wyświetlać licznik odpowiedzi na liście tematów?";
	const TOPIC_REPLIES_DISPLAY = "Wyświetlanie licznika odpowiedzi";
	const TOPIC_REPLIES_DISPLAY_DESC = "jak wyświetlać licznik odpowiedzi: jako etykietę poniżej tytułu tematu czy jako kolumnę tekstową?";
	const FORUMS_CACHE_ENGINE = "Silnik pamięci podręcznej";
	const FORUMS_CACHE_ENGINE_DESC = "wybierz sposób przechowywania danych w pamięci podręcznej, nie zmieniaj tej opcji dopóki nie masz zainstalowanego i uruchomionego na serwerze nowego silnika pamięci podręcznej.";
	const CFU_SEARCH = "wyszukiwanie";
	const CFU_SYSTEM = "system";
	const CFU_STYLE = "styl";
	const DEEP = "w głąb";
	const TAGS = "według etykiet";
	const TEXT = "tekst";
	const LABEL = "etykieta";
	const SEND_POST_EDIT_EMAIL = "email po edycji wpisu";
	const SEND_POST_EDIT_EMAIL_DESC = "czy wysyłać powiadomienie email'em, gdy wpis był poddany edycji?";
	const POSTS_EDIT_NOTIFY_GROUPS = "Grupy powiadamiane o edycji wpisu";
	const POSTS_EDIT_NOTIFY_GROUPS_DESC = "grupy użytkowników, które będą powiadamiane, gdy jakikolwiek wpis zostanie poddany edycji";
	const AUTOLOCK_TOPIC_INACTIVE_LIMIT = "Automatyczne blokowanie tematów";
	const AUTOLOCK_TOPIC_INACTIVE_LIMIT_DESC = "liczba dni, po których temat zostanie automatycznie zablokowany, gdy użytkownik spróbuje dodać do niego nowy wpis, ustaw 0 by wyłączyć.";
	const SEARCH_METHOD = "Metoda wyszukiwania";
	const SEARCH_METHOD_DESC = "jak realizowane jest wyszukiwanie, dotyczy wyszukiwania we wszystkich / w pojedynczym forum (wyszukiwanie w tematach jest zawsze 'w głąb'), 'w głąb' oznacza przeszukanie wszystkich tekstów wpisów, co czasami może nie być dość sprawne.";
	const SAVE_SEARCH_TAGS = "Hasła wyszukiwania jako etykiety";
	const SAVE_SEARCH_TAGS_DESC = "automatycznie wygeneruj nowe etykiety z wyszukiwanych haseł";
	const UPDATE_TAGS_HITS = "Aktualizuj licznik trafień dla etykiet";
	const UPDATE_TAGS_HITS_DESC = "zwiększaj licznik trafień dla etykiet podczas wyszukiwań";
	const AUTO_TAG_TOPICS = "Automatyczne tagi dla tematów";
	const AUTO_TAG_TOPICS_DESC = "automatycznie dodawaj etykiety do tematów podczas dopisywania tematu bądź wpisu.";
	const LIST_TOPIC_TAGS = "Lista etykiet dla tematu";
	const LIST_TOPIC_TAGS_DESC = "wyświetl listę etykiet dowiązanych do otwartego tematu poniżej tytułu tematu";
	const ENABLE_TOPIC_TAGS = "Włącz etykiety dla tematów";
	const ENABLE_TOPIC_TAGS_DESC = "włącza obsługę etykiet dla tematów lub wyświetlanie pola do wprowadzenia etykiety lub list etykiet";
	const POSTS_FONT_SIZE = "Rozmiar czcionki dla wpisów";
	const POSTS_FONT_SIZE_DESC = "globalny rozmiar czcionki dla wszystkich treści wpisów";
	const GLOBAL_CSS = "Globalny CSS";
	const GLOBAL_CSS_DESC = "Dodaj dowolny kod CSS, który będzie ładowany na każdej stronie forum, to będzie nadpisane przez każdy styl wewnątrz plików i nie będzie nadpisane podczas aktualizacji forum.";
	const ALLOW_USERS_AVATARS = "Obsługa awatarów";
	const ALLOW_USERS_AVATARS_DESC = "zezwól użytkownikom na ładowanie swoich awatarów do swoich profili";
	const SHOW_POST_AUTHOR_AVATAR = "Wyświetl awatary wpisów";
	const SHOW_POST_AUTHOR_AVATAR_DESC = "pokaż obraz awatara autora wpisu wewnętrz strony tematu";
	const AVATAR_SIZE = "Rozmiar awatara";
	const AVATAR_SIZE_DESC = "maksymalny rozmiar dla obrazu awatara, w KB";
	const AVATAR_WIDTH = "Szerokość awatara";
	const AVATAR_WIDTH_DESC = "maksymalna szerokość obrazu awatara";
	const AVATAR_HEIGHT = "Wysokość awatara";
	const AVATAR_HEIGHT_DESC = "maksymalna wysokość obrazu awatara";
	const DATE_TIMEZONE_DESC = "ustaw domyślną strefę czasową dla obszaru forum";
	const RANKS_MANAGER = "zarządzanie rangami";
	const RT_SUPPORT = "Wsparcie dla motywu Rocket";
	const RT_SUPPORT_DESC = "dodaje ekstra wsparcie, jeśli masz jeden z najnowszych motywów Rocket.";
	const TOPIC_POPULAR_LIMIT = "Popularny temat - minimum";
	const TOPIC_POPULAR_LIMIT_DESC = "minimalna liczba odwiedzin wpisów dla tematu, aby uznać temat za popularny";
	const TOPIC_HOT_LIMIT = "Gorący temat - minimum";
	const TOPIC_HOT_LIMIT_DESC = "minimalna liczba wpisów dla tematu, aby uznać dany temat za 'gorący'";
	const BOARD_DISPLAY = "Wyświetlanie forum";
	const BOARD_DISPLAY_DESC = "wybierz wygląd strony głównej spośród domyślnego wyświetlania kategoriami lub pełnego z tematami.";
	const CFU_DEFAULT = "Domyślne";
	const USERNAMES_AVATARS = "Awatary obok nazw użytkowników";
	const USERNAMES_AVATARS_DESC = "czy wyświetlać miniaturkę awatara obok nazwy użytkownika?";
	const POSTS_MINI_PROFILE = "Zamieszczaj mini profil";
	const POSTS_MINI_PROFILE_DESC = "czy wyświetlać mini profil autora w każdym wpisie?";
	const USERNAMES_MINI_PROFILE = "Mini info o użytkowniku";
	const USERNAMES_MINI_PROFILE_DESC = "czy pokazywać mini informację o użytkowniku po najechaniu myszką na nazwę użytkownika?";
	const ACTIVE_TOPIC_DAYS = "Dni tematu aktywnego";
	const ACTIVE_TOPIC_DAYS_DESC = "liczba minionych dni, podczas których temat był uważany za aktywny";
	const EXTRA_INFO = "ekstra info";
	const ENABLE_EXTRA_TOPIC_INFO = "Rozszerzona informacja o temacie";
	const ENABLE_EXTRA_TOPIC_INFO_DESC = "włącza rozszerzenie informacji o temacie: użytkownicy będą mogli dodawać dodatkowe informacje podczas zamieszczania nowego tematu";
	const EXTRA_TOPIC_INFO_CODE = "Kod wprowadzania";
	const EXTRA_TOPIC_INFO_CODE_DESC = "kod HTML dla pól obsługujących rozszerzoną informację, nazwy pól powinny być w postaci: topic_info[name], np.: topic_info[version]";
	const EXTRA_TOPIC_INFO_OUTPUT = "Kod wyświetlania";
	const EXTRA_TOPIC_INFO_OUTPUT_DESC = "kod potrzebny do wyświetlenia rozszerzonej informacji, użyj nawiasów klamrowych do wyświetlania, np.: {topic_info.version}";
	const DISCUSSIONS = "Dyskusje";
	const FORUMS_FORUM_REQUIRED = "Proszę wybrać forum";
	const FORUM_ICON = "Ikonki forum";
	const QUICK_POST_TOOLS = "Szybkie narzędzia dla wpisów";
	const QUICK_POST_TOOLS_DESC = "gdy włączone: wyświetla listę ikonek dla szybkich poleceń zamiast listy odnośników.";
	const DISPLAY_FORUM_ICON = "Wyświetlanie ikonki forum";
	const DISPLAY_FORUM_ICON_DESC = "czy wyświetlać ikonkę forum na głównej stronie forum?";
	const PRIVATE_MESSAGES = "prywatne wiadomości";
	const ENABLE_PRIVATE_MESSAGES = "Włącz obsługę PW";
	const ENABLE_PRIVATE_MESSAGES_DESC = "włączenie prywatnych wiadomości (PW) pomiędzy użytkownikami.";
	const ENABLE_MESSAGE_NOTIFY = "Włącz powiadomienia";
	const ENABLE_MESSAGE_NOTIFY_DESC = "czy wysłać email do odbiorcy po otrzymaniu nowej prywatnej wiadomości?";
	const ENABLE_MESSAGES_GROUPS_FILTER = "Filtrowanie grup";
	const ENABLE_MESSAGES_GROUPS_FILTER_DESC = "włącz filtrowanie grup, które będą miały uprawnienia do otrzymywania prywatnych wiadomości";
	const MESSAGES_ALLOWED_GROUPS = "Grupy z PW";
	const MESSAGES_ALLOWED_GROUPS_DESC = "grupy uprawnione do otrzymywania prywatnych wiadomości";
	const POSTS_ORDERING_EARLIEST_FIRST = "data wpisu - od najstarszego";
	const POSTS_ORDERING_LATEST_FIRST = "data wpisu - od najnowszego";
	const ENABLE_TOPICS_TRACK = "Włącz odczyt tematów";
	const ENABLE_TOPICS_TRACK_FRONT_DESC = "śledzenie statusu przeczytania tematów";
	const ENABLE_TOPICS_TRACK_DESC = "włącza śledzenie statusu przeczytania tematów: gdy jest włączone, użytkownicy mają możliwość włączenia statusu przeczytania tematów w preferencjach forum";
	const REPLACER = "Replacer";
	const SEARCH_FLOODING_LIMIT = "Limit zatopienia";
	const SEARCH_FLOODING_LIMIT_DESC = "liczba sekund minimalnego odstępu uruchomienia wyszukiwania przez tego samego użytkownika";
	const AUTO_REPLY = "automatyczna odpowiedź";
	const AUTO_REPLY_SECURITY_TOKEN = "Żeton bezpieczeństwa";
	const AUTO_REPLY_SECURITY_TOKEN_DESC = "ciąg znaków chroniący adres url automatycznej odpowiedzi przed publicznym dostępem.";
	const AUTO_REPLY_CONTENT = "Treść odpowiedzi";
	const AUTO_REPLY_CONTENT_DESC = "zawartość automatycznej odpowiedzi, możesz użyć PHP, brak zwracanej treści powoduje niewysłanie automatycznej odpowiedzi, masz dostęp tytułu i tekstu postu poprzez: \$this->data['title'] or ['text']";
	const ENABLE_AUTO_REPLY = "Włącz automatyczną odpowiedź";
	const ENABLE_AUTO_REPLY_DESC = "po zamieszczeniu nowego tematu, usługa automatycznej odpowiedzi analizuje tekst pierwszego wpisu i przetwarza poniższy kod w celu wysłania automatycznej odpowiedzi.";
	const AUTO_REPLY_USER_ID = "id użytkownika";
	const AUTO_REPLY_USER_ID_DESC = "identyfikator użytkownika dla konta użytego do zrobienia automatycznej odpowiedzi.";
	const SEARCH_WORDS_LIMIT = "Limit słów";
	const SEARCH_WORDS_LIMIT_DESC = "ograniczenie liczby wyszukiwanych słów, duże liczby mogą powodować problemy przy dużych forach";
	const SEARCH_START_FROM = "Opcje dla Zacznij od wpisów";
	const SEARCH_START_FROM_DESC = "wartości dostępne jako rozwijana lista dla pola Zacznij od wpisów, po prostu wpisz liczbę + znak reprezentujący okres, tzn.: 1y dla '1 roku' lub 3m dla '3 miesięcy' lub 1w dla '1 tygodnia'";
	const SEARCH_START_FROM_VALUE = "Wartość domyślna";
	const SEARCH_START_FROM_VALUE_DESC = "jedna z powyżej określonych, która będzie używana jako domyślna";
	const ENABLE_TOPICS_FAVORITES = "Włącz ulubione";
	const ENABLE_TOPICS_FAVORITES_DESC = "włączenie opcji ulubionych tematów: użytkownicy będą mogli dodawać tematy do swojej listy ulubionych";
	const AUTHOR_DELETE_AFFECTED_TOPICS_LIMIT = "Limit wpisów usuwanego autora";
	const AUTHOR_DELETE_AFFECTED_TOPICS_LIMIT_DESC = "granica dotkniętych wpisów, powyżej której użytkownik nie może zostać usunięty, wpisz tu małą liczbę w celu zabezpieczenia się przed usunięciem niewłaściwego konta.";
	const AUTHOR_DELETE_CODE_CHECK = "Kod kontrolny przy usuwaniu autora";
	const AUTHOR_DELETE_CODE_CHECK_DESC = "kod jest uruchamiany przed usunięciem użytkownika, jeśli zwróci wartość logiczną false to usuwanie nie zadziała, pomocne gdy sprawdzasz niektóre dane użytkownika,  zmienna \$author_id zawiera id usuwanego użytkownika.";
	const RELEVANCE = "trafność";
	const DEEP_SEARCH_TYPE = "Typ wyszukiwania w głąb";
	const DEEP_SEARCH_TYPE_DESC = "rodzaj zapytania używanego dla wyszukiwania deep(FULLTEXT).";
	const SEARCH_ORDER = "Kolejność wyników";
	const SEARCH_ORDER_DESC = "kolejność używana do wyświetlania wyników wyszukiwania";
	const ENABLE_QUICK_REPLY = "Szybka odpowiedź";
	const ENABLE_QUICK_REPLY_DESC = "włącz opcję szybkiej odpowiedzi: spowoduje wyświetlanie obszaru tekstowego do wpisania szybkiej odpowiedzi poniżej listy wpisów dla tematów";
	const CFU_LANGUAGES = "Języki";
	const CFU_LANGUAGES_DESC = "lista języków oddzielonych przecinkami, kategoria zostanie ukryta dla użytkowników przeglądających forum z ustawionym innym (niż tu wymienione) aktywnym językiem, np.: fr-FR,en-GB";
	const ENABLE_TOPICS_FEATURED = "Polecane tematy";
	const ENABLE_TOPICS_FEATURED_DESC = "włącz listę polecanych tematów i odpowiedni przycisk";
	const ENABLE_MINI_PAGER = "Mini pager";
	const ENABLE_MINI_PAGER_DESC = "Enable the mini pagination for topics in topics pages.";
	const ENABLE_VOTES = "Włącz głosowanie";
	const ENABLE_VOTES_DESC = "pozwól użytkownikom forum oddawać głosy na tematy/wpisy.";
	const ENABLE_DOWN_VOTES = "Włącz głosy negatywne";
	const ENABLE_DOWN_VOTES_DESC = "czy użytkownik może oddać głos negatywny?";
	const ENABLE_REPUTATION = "Włącz reputację";
	const ENABLE_REPUTATION_DESC = "obliczanie i pamiętanie punktów reputacji dla każdego użytkownika";
	const VOTE_REPUTATION_WEIGTH = "Waga głosu reputacji";
	const VOTE_REPUTATION_WEIGTH_DESC = "wartość wagi reputacji przyznawanej użytkownikowi, gdy któryś z jego wpisów otrzyma głos pozytywny lub głos negatywny";
	const POST_REPUTATION_WEIGTH = "Reputacja wpisu";
	const POST_REPUTATION_WEIGTH_DESC = "wartość reputacji przyznanej użytkownikowi, gdy zamieści odpowiedź.";
	const TOPIC_REPUTATION_WEIGTH = "Reputacja tematu";
	const TOPIC_REPUTATION_WEIGTH_DESC = "wartość reputacji przyznanej użytkownikowi, gdy zamieści temat.";
	const ANSWER_REPUTATION_WEIGTH = "Reputacja odpowiedzi";
	const ANSWER_REPUTATION_WEIGTH_DESC = "wartość reputacji przyznanej użytkownikowi, gdy jego wpis otrzyma tytuł najlepszej odpowiedzi.";
	const POST_TITLE_AUTHOR = "Autor w tytule wpisu";
	const POST_TITLE_AUTHOR_DESC = "pokaż nazwę/awatara autora w tytule wpisu";
	const ENABLE_COMMUNITY_SUPPORT = "Wsparcie dla Community?";
	const ENABLE_COMMUNITY_SUPPORT_DESC = "czy synchronizować dane forum z ChronoCommunity ? musisz mieć zainstalowane ChronoCommunity.";
	const TOPIC_SUBSCRIBE_ENABLED = "Włącz subskrypcję tematów";
	const TOPIC_SUBSCRIBE_ENABLED_DESC = "automatycznie włącza subskrypcję tematu użytkownikowi korzystającemu z szybkiej odpowiedzi, automatycznie zaznacza opcję subskrypcji w odpowiedzi oraz przy tworzeniu nowego tematu.";
	const ENABLE_SMTP = "Włącz SMTP";
	const SMTP_SECURE = "Bezpieczeństwo SMTP";
	const SMTP_SECURE_DESC = "Model bezpieczeństwa SMTP Twojego serwera, jeśli występuje, zwykle ssl lub tls, używane wartości są zależne od wielkości znaków, zwykle pisane małymi literami, tzn: tls, ale NIE TLS";
	const SMTP_HOST = "nazwa serwera SMTP";
	const SMTP_PORT = "numer portu SMTP";
	const SMTP_USERNAME = "nazwa użytkownika (SMTP)";
	const SMTP_PASSWORD = "hasło (SMTP)";
	const INLINE_IMAGES_DISPLAY = "Wyświetlanie obrazów";
	const INLINE_IMAGES_DISPLAY_DESC = "Wybierz metodę powiększania obrazów w tekście dla zobaczenia większej liczby szczegółów.";
	const ENLARGABLE = "powiększanie";
	const MAGNIFIED = "lupa";
	const MODAL = "nowe okno modalne";
	const AUTO_COLLAPSE_CODE = "Zwinąć kod";
	const AUTO_COLLAPSE_CODE_DESC = "ładuj domyślnie obszar z kodem we wpisach jako zwinięty, jeśli jest włączony, to pojawi się odnośnik powyżej obszaru z kodem umożliwiający użytkownikowi proste rozwinięcie okna dialogowego.";
	const USER_DIRECTORY_FILES = "Katalog użytkownika dla plików";
	const USER_DIRECTORY_FILES_DESC = "zapisywanie załączników w katalogach zgodnych z id użytkownika wysyłającego plik(i), należy ustawić przed pierwszym użyciem forum, jeśli zmiana nastąpi później, to Twoim zadaniem będzie przesunięcie plików do odpowiednich katalogów.";
	const PERMISSIONS_LEGEND = "Legenda dla uprawnień";
	const ALLOWED_DESC = "zezwól tej grupie i WSZYSTKIM PODRZĘDNYM grupom wykonywać wskazane polecenia, przyjmując że grupy podrzędne mają ustawione 'dziedziczenie'.";
	const INHERITED_DESC = "nie ustawia konkretnego uprawnienia, lecz dziedziczy uprawnienie po grupie nadrzędnej.";
	const NOT_SET_DESC = "zabroń tej grupie wykonania wskazanego polecenie, nie wpływa na grupy podrzędne, nawet wtedy gdy mają ustawione uprawnienia na 'dziedziczenie'.";
	const DENIED_DESC = "zabroń tej grupie i WSZYSTKIM PODRZĘDNYM grupom wykonania wskazanego polecenie, niezależnie od ich uprawnień, obojętne, czy mają 'dozwolone' czy 'dziedziczenie'.";
	const LOAD_FORUMS_LIST = "Lista for dla kategorii";
	const LOAD_FORUMS_LIST_DESC = "wyświetla listę for dla każdej kategorii na głównej stronie forum, ustaw 'nie' jeśli chcesz by lista for pokazywała się dopiero gdy użytkownik wejdzie do konkretnej kategorii.";
	const POSTS_LOADER_ENABLED = "Włącz ładowarkę wpisów";
	const POSTS_LOADER_ENABLED_DESC = "włącza ładowarkę wpisów na stronach tematów, użytkownik będzie mógł wczytać (zobaczyć) więcej wpisów bez zmiany strony, w przypadku gdy temat ma więcej niż 1 stronę wpisów.";
	const POSTS_LOADER_METHOD = "Metoda wczytywania";
	const POSTS_LOADER_METHOD_DESC = "możesz użyć przycisku do pobrania kolejnych wpisów LUB wczytywać wpisy automatycznie gdy użytkownik przewinie stronę blisko jej końca.";
	const POSTS_LOADER_LIMIT = "Limit ładowarki";
	const POSTS_LOADER_LIMIT_DESC = "liczba wpisów wczytywana za każdym razem przez ładowarkę, gdy zostanie wywołana przyciskiem lub przewijaniem strony.";
	const POSTS_LOADER_SCROLL_DISTANCE = "Odstęp przewijania";
	const POSTS_LOADER_SCROLL_DISTANCE_DESC = "minimalny odstęp (w pikselach) od końca listy wpisów przeglądanych przez użytkownika, gdy zostanie wywołana ładowarka wpisów.";
	const POSTS_LOADER = "ładowarka wpisów";
	const SCROLL = "przewijanie";
	const BUTTON = "przycisk";
	const ENABLE_TOPIC_PREVIEW = "Podgląd tematu";
	const ENABLE_TOPIC_PREVIEW_DESC = "czy włączyć podgląd tematu w trakcie pisania odpowiedzi?";
}