<?php
require_once 'castle_engine_functions.php';
castle_header('Cross-platform (desktop, mobile, consoles...) projects');

$toc = new TableOfContents(
  array(
    new TocItem('Introduction', 'introduction'),
    new TocItem('Standard GameInitialize unit', 'initialize_unit'),
    new TocItem('Optional standalone program file', 'program'),
    new TocItem('Compiling and debugging on mobile platforms', 'compiling_debuggng'),
    new TocItem('Differences in input handling between mobile (touch) and desktop (mouse) platforms', 'input'),
    new TocItem('Things to avoid in cross-platform games', 'avoid'),
  )
);

echo castle_thumbs(array(
  array('filename' => 'android12glued.png', 'titlealt' => 'Various Android applications developed using Castle Game Engine'),
));
?>

<?php echo $toc->html_toc(); ?>

<?php echo $toc->html_section(); ?>

<p><i>Castle Game Engine</i> supports many platforms:

<ul>
  <li><p>desktop (Windows, Linux, Mac OS X, FreeBSD, Raspberry Pi...),
  <li><p>mobile (<a href="android">Android</a>, <a href="ios">iOS</a>),
  <li><p><a href="nintendo_switch">Nintendo Switch</a>.
</ul>

<p>The engine hides as much as possible differences between these platforms,
exposing a nice cross-platform API.

<?php echo $toc->html_section(); ?>

<p>New projects created using the <a href="manual_editor.php">CGE editor</a>
are automatically cross-platform. All the  <i>"New Project"</i> templates (including <i>"Empty"</i>,
the simplest) follow the same approach.

<p>The starting point of every cross-platform project is a unit that initializes <code>Application.MainWindow</code>.
By default, this unit is called <code>GameInitialize</code> and it is present in your project
in <code>code/gameinitialize.pas</code>.
This unit looks like this:

<?php echo pascal_highlight_file('code-samples/gameinitialize.pas', false); ?>

<p>The <code>initialization</code> section at the bottom of the <code>GameInitialize</code>
unit should only assign a callback to <?php echo cgeRef('TCastleApplication.OnInitialize', 'Application.OnInitialize'); ?>,
and create and assign <code>Application.MainWindow</code>.
Most of the actual initialization (loading images, resources, setting up player
and such) should happen in the callback you assigned to <?php echo cgeRef('TCastleApplication.OnInitialize', 'Application.OnInitialize'); ?>.
At that point you know that your program is ready to load and prepare resources.

<!--
<p>The initialization <b>must assign the <?php echo cgeRef('TCastleApplication.MainWindow', 'Application.MainWindow'); ?></b> instance,
that will be used by platform-specific program/library code.
It should be a <?php echo cgeRef('TCastleWindow'); ?> class
instance (it may be a descendant of this class, of course).
-->

<p>This <code>GameInitialize</code> unit can be included by the main program / library file.
But usually you should not maintain yourself this main program / library file.
The <a href="https://castle-engine.io/build_tool">build tool</a>
will automatically generate the main program / library using the <code>GameInitialize</code> unit,
as necessary for compilation on a particular platform.

<?php echo $toc->html_section(); ?>

<p>Optionally, to be able to run and debug the project from Lazarus or Delphi,
we need a program file like <code>xxx_standalone.dpr</code>.

<p>You should not create or maintain such file manually.
Instead, it should be automatically generated for new projects.
You can also always regenerate it using editor menu <i>"Code -&gt; Regenerate Project (overwrites LPI, DPR, DPROJ, CastleAutoGenerated)"</i>
or using command-line:

<pre>castle-engine generate-program</pre>

<p>You should not customize the generated <code>xxx_standalone.dpr</code>
file. While such customizations would work in the short term,
they would prevent from regenerating this file. It's better to leave it auto-generated,
and place your necessary initialization (even things like command-like parsing)
in your units, like <code>gameinitialize.pas</code>.

<p>To make our build tool use your customized program file (instead of the auto-generated
one), be sure to set <code>standalone_source</code> in the <code>CastleEngineManifest.xml</code>.
It is already set OK in new projects created using our editor.

<!--

<p>Note that <b>you can edit and run the desktop version using <i>Lazarus</i></b>,
to benefit from Lazarus editor, code tools, integrated debugger...
Using our build tool does not prevent using Lazarus at all!
Just open the created LPI file.

<ul>
  <li>If you did not create the <code>lpi</code> file using
    <code>castle-engine generate-program</code>, you can create it manually:
    Simply create in Lazarus a new project using the <i>New -&gt; Project -&gt; Simple Program</i>
    option. Or (if you already have the <code>xxx.dpr</code> file) create
    the project using <i>Project -&gt; New Project From File...</i>.
  <li>Add to the project requirements packages <code>castle_base</code> and <code>castle_window</code>
    (from <i>Project -&gt; Project Inspector</i>, you want to <i>Add</i> a <i>New Requirement</i>).
  <li>Save the project as <code>my_fantastic_game_standalone.lpi</code>.
  <li>...and develop and run as usual.
  <li>Edit the main <code>my_fantastic_game_standalone.dpr</code>
    file using the <i>Project -&gt; View Project Source</i> option in Lazarus.
</ul>
-->

<?php echo $toc->html_section(); ?>

<p>Developing for mobile platforms requires installing
some special tools. Everything is explained on these platform-specific pages:

<ul>
  <li><p><a href="https://castle-engine.io/android">Developing for Android</a>.

    <p>Once you have installed <a href="https://castle-engine.io/android">Android SDK, NDK and FPC cross-compiler for Android</a> then you can build and run for Android:

    <pre>castle-engine package --target=android # creates APK
castle-engine install --target=android # installs on Android device connected through USB
castle-engine run --target=android # runs on Android device</pre>

    <p>You can also create AAB file for Android, to upload to Google Play.
    See the <a href="build_tool">build tool</a> docs.

  <li><p><a href="https://castle-engine.io/ios">Developing for iOS (iPhone, iPad)</a>.

    <p>If you have installed <a href="https://castle-engine.io/ios">FPC cross-compiler for iOS</a> then you can also build for iOS:

    <pre>castle-engine package --target=iOS # creates an Xcode project to run on device or simulator</pre>

    <p>You can also create IPA file for iOS.
    See the <a href="build_tool">build tool</a> and <a href="https://castle-engine.io/ios">iOS</a> docs.
</ul>

<?php echo $toc->html_section(); ?>

<p>To create portable games you have to think about different types
of inputs available on mobile platforms vs desktop.
The engine gives you various helpers, and abstracts various things
(for example, mouse clicks and touches can be handled using the same API,
you just don't see multi-touches on desktop).
But it's not possible to 100% hide the differences,
because some concepts just cannot work &mdash; e.g. mouse look cannot work
on touch interfaces (since we don't get motion events when you don't press...),
keyboard is uncomfortable on touch devices,
multi-touch doesn't work on desktops with a single mouse and so on.

<p>To account for this, you can adjust your input handling depending on the
<?php echo cgeRef('TCastleApplicationProperties.TouchDevice', 'ApplicationProperties.TouchDevice'); ?> value.
It is automatically initialized to <code>true</code> on touch devices without keyboard / mouse (like mobile),
and <code>false</code> elsewhere (like on typical desktops).

<p>For navigation in 3D on mobile, we have a special UI control
<?php echo cgeRef('TCastleTouchNavigation'); ?>.
This allows to easily navigate (examine / walk / fly) in the viewport by dragging on special controls
in the corners.

<?php echo $toc->html_section(); ?>

<ul>
  <li><p>Do not call <code>Window.Open</code> or <code>Window.Close</code> or
    <code>Application.Run</code>
    inside the cross-platform unit like <code>gameinitialize.pas</code>.

    <p>These methods should never be explicitly called on non-desktop platforms.
    Even on the desktop platforms, they should only be called from the main program file
    (<code>xxx_standalone.dpr</code>), which may be auto-generated by the build tool.

  <li><p>Do not call <code>Application.Terminate</code> on platforms
    where users don't expect it. Use
    <?php echo cgeRef('TCastleApplicationProperties.ShowUserInterfaceToQuit', 'ApplicationProperties.ShowUserInterfaceToQuit'); ?>
    to show or hide the appropriate user interface,
    like a "<i>Quit Game</i>" button.
    Mobile applications generally don't have
    a buttton to quit &mdash; instead, mobile users just switch
    to a different application (or desktop) using the standard buttons.

    <p>Also, the <code>Application.Terminate</code> may not be implemented
    on some platforms where <code>ShowUserInterfaceToQuit</code> is <code>false</code>.

  <li><p>Do not create more than one <code>TCastleWindow</code> instance.
    If you want your game to be truly portable to <b>any</b> device &mdash;
    you have to limit yourself to using only one window.
    For normal games that's probably natural anyway.

    <p>Note that the engine still supports, and will always support,
    multiple-window programs.
    See e.g.<code>castle_game_engine/examples/window/multi_window.dpr</code> example.
    However, it only works on normal desktop systems.
    It is not possible to do portably (to seamlessly work on mobile and console systems)
    since other platforms don't have a concept of "window" that works like on desktops.
</ul>

<?php
castle_footer();
?>
