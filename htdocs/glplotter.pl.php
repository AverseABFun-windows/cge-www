<?php
  require_once 'vrmlengine_functions.php';

  camelot_header("glplotter", LANG_PL,
    "glplotter - program w OpenGLu do rysowania r�norakich figur, wykres�w itp. " .
    "na dwuwymiarowej siatce.");
?>

<?php
  echo pretty_heading("glplotter", VERSION_GLPLOTTER);
  echo '<table align="right">' .
    '<tr><td>' . medium_image_progs_demo("glplotter_screen_demo_1.png", "glplotter", false) .
    '<tr><td>' . medium_image_progs_demo("glplotter_screen_demo_2.png", "glplotter", false) .
    '<tr><td>' . medium_image_progs_demo("glplotter_screen_demo_3.png", "glplotter", false) .
    '</table>';
?>

<p>glplotter to program rysuj�cy r�ne figury, wykresy funkcji, zbiory kresek itp.
na dwuwymiarowym uk�adzie wsp�rz�dnych. Uruchamiaj�c program podajesz mu jako
parametry nazwy plik�w z kt�rych ma odczyta� wszystkie wykresy do
narysowania, np.
<pre>
  glplotter plik.plot
</pre>

<p>��cz�c glplotter z programami kt�re mog� automatycznie generowa� r�ne
pliki z wykresami (jak <?php echo a_href_page("gen_funkcja", "gen_funkcja"); ?>)
mo�na u�ywa�
glplottera jako programu do ogl�dania np. wykres�w funkcji. Polecenie
<pre>
  gen_funkcja "sin(x)" -10 10 0.1 | glplotter -
</pre>
wy�wietli wykres funkcji sinus na odcinku [-10; 10] a polecenia
<pre>
  gen_funkcja "sin(x)" -10 10 0.1 > plot.1
  gen_funkcja "x^2" -10 10 0.1 > plot.2
  glplotter plot.1 plot.2
</pre>
wy�wietl� wykresy funkcji sinus i x<sup>2</sup> na jednym obrazku.

<p>Oto program. �adna instalacja nie jest potrzebna, po prostu rozpakuj archiwum
w jakim� katalogu i stamt�d uruchamiaj <tt>glplotter</tt>.
<?php echo_standard_program_download('glplotter', 'glplotter',
  VERSION_GLPLOTTER, true); ?>

<p><?php echo SOURCES_OF_THIS_PROG_ARE_AVAIL; ?>

<p>Dokumentacja:
<ol>
  <li><a href="#section_params">Parametry</a>
  <li><a href="#section_controls">Obs�uga</a>
  <li><a href="#section_plot_format">Format plik�w z wykresami</a>
  <li><a href="#section_depends">Wymagania</a>
</ol>

<h3><a name="section_params">Parametry</a></h3>

<p>Uruchom jako
<pre>
  glplotter [OPTION]... [FILE]...
</pre>

<p>Podaj dowolnie wiele nazw plik�w (nazwa pliku - (my�lnik) oznacza standardowe
wej�cie).

<p>Opcje kontroluj�ce jakie elementy wy�wietla�:
<pre>
  --crosshair           --no-crosshair
  --point-coords        --no-point-coords
  --osie-xy             --no-osie-xy
  --map                 --no-map
  --grid-1              --no-grid-1
  --podzialka-1         --no-podzialka-1
  --liczby-1            --no-liczby-1
  --grid-pi             --no-grid-pi
  --podzialka-pi        --no-podzialka-pi
  --liczby-pi           --no-liczby-pi
  --grid-custom         --no-grid-custom
  --podzialka-custom    --no-podzialka-custom
  --liczby-custom       --no-liczby-custom
  --only-points         --no-only-points
</pre>

<p>Opcje <tt>--light</tt> i <tt>--dark</tt> okre�laj� jasny lub ciemny schemat
kolor�w.

<p>Opcja <tt>--custom-size SIZE</tt> (lub <tt>-c SIZE</tt>) podaje rozmiar dla
<ul>
  <li>siatki wy�wietlanej po podaniu <tt>--grid-custom</tt>
    albo przyci�ni�ciu Ctrl + G
  <li>podzia�ki wy�wietlanej po podaniu <tt>--podzialka-custom</tt>
    albo przyci�ni�ciu Ctrl + P
  <li>podzia�ki liczbowej wy�wietlanej po podaniu <tt>--liczby-custom</tt>
    albo przyci�ni�ciu Ctrl + L
</ul>

<p>Patrz tak�e <?php echo a_href_page(
"standardowe parametry moich program�w w OpenGL'u", "opengl_options") ?> i
<?php echo a_href_page(
"og�lne uwagi o parametrach dla moich program�w", "common_options") ?>.

<h3><a name="section_controls">Obs�uga</a></h3>

<p>Do dyspozycji masz r�ne polecenia w menu, przegl�daj�c menu
mo�esz te� dowiedzie� si� jakie skr�ty klawiszowe s� przypisane do
odpowiednich polece�. Nie b�d� tu wymienia� wszystkich
dost�pnych polece�, po prostu
uruchom program i pobaw si� nimi - ich znaczenie powinno by�
zazwyczaj jasne.

<p>Klawisze jakie nie s� obecne jako polecenia w menu:
<ul>
  <li>strza�ki : przesuwanie wykresu
  <li>+/- : skalowanie
    <!-- (z nieruchomym miejscem pod celownikiem, tzn. podczas skalowania
         punkt na ktory wskazuje "celownik" pozostaje ten sam) -->
  <li>PgUp / PgDown : obracaj wykres <!-- wzgledem srodka okienka -->
</ul>

<p>Trzymanie CTRL podczas przyciskania tych klawiszy spowoduje �e wykres
b�dzie 10 razy szybciej przesuwany / skalowany / obracany.
Trzymanie SHIFT oznacza "100 razy szybciej".
Konsekwentnie, trzymaj jednocze�nie CTRL i SHIFT aby klawisze
dzia�a�y 1000 razy szybciej.

<p>Klawisz F10 (i odpowiednie polecenie menu) zapami�tuj� aktualny
obraz wykresu do pliku o nazwie <tt>glplotter_screen_%d.png</tt>
w aktualnym katalogu, gdzie <tt>%d</tt> b�dzie pierwsz� woln� liczb�.

<p>Mo�na przesuwa� wykres przeci�gaj�c go myszk�, tzn. przesuwaj�c myszk�
przy wci�nietym lewym klawiszu.

<h3><a name="section_plot_format">Format plik�w z wykresami</a></h3>

To co nazywam tu "wykresem" to po prostu zupe�nie swobodny zbi�r odcink�w.
Odcinki te nie musz� prezentowa� wykresu jakiej� funkcji - mog� by� dowolnie
po�o�one wzgl�dem siebie, dowolnie si� przecina� itp.

<p>Format pliku wykresu: ka�da linia to
<ul>
  <li>Komentarz, gdy linia zaczyna si� znakiem <tt>#</tt> (hash).
  <li>Kolejny punkt na linii wykresu,
    gdy linia to dwie liczby rzeczywiste oddzielone bia�ymi znakami.
    Liczba rzeczywista mo�e by� zapisana w postaci dziesi�tnej lub wyk�adniczej,
    np. <tt>3.14</tt> lub <tt>10e-3</tt>.
  <li>Przerwa w linii wykresu,
    gdy linia zawiera tylko s�owo <tt>break</tt>.
  <li>Nazwa wykresu (u�ywana do wy�wietlania mapki w lewym-dolnym rogu okienka)
    w postaci <tt>name=&lt;nazwa_wykresu&gt;</tt>.
</ul>
Bia�e znaki na pocz�tku i na ko�cu linii s� zawsze dozwolone i ignorowane.

<h3><a name="section_depends">Wymagania</a></h3>

<?php echo depends_ul( array(
  DEPENDS_OPENGL,
  DEPENDS_LIBPNG_AND_ZLIB,
  DEPENDS_UNIX_GLWINDOW_GTK_2,
  DEPENDS_MACOSX) );
?>

<?php
  if (!IS_GEN_LOCAL) {
    $counter = php_counter("glplotter", TRUE);
  };

  camelot_footer();
?>