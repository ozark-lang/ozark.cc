<!DOCTYPE html>
<html lang="en">
	<?php
		$title = "Ozark Language - Documentation - Objects &amp; Pointers";
		$description = "Ozark is a purely object-oriented programming language designed to build software with maximum modularity, inherent clarity of purpose, and a long lifespan.";
		$active = 'documentation';
		$document = 'objects';
		require('../includes/header.php');
	?>
	<body itemscope itemtype='http://schema.org/Language'>
		<?php require ('../includes/top.php'); ?>
		<section class='white short'>
			<div class='container'>
				<div class='row'>
					<div class='col-md-10 col-md-offset-1'>
						<div class='row'>
							<div class='col-sm-3'>
								<?php require('../includes/documentation-nav.php'); ?>
							</div>
							<div class='col-sm-9'>
								<div class='row'>
									<div class='col-sm-7'>
										<h1 class='main-heading' id="overview">Objects &amp; Pointers</h1>
									</div>
									<div class='col-sm-5'>
										<?php require('../includes/documentation-search.php'); ?> 
									</div>
								</div>
								<div class='row'>
									<div class='col-lg-10'>
										<main>
											<p><strong>Object</strong> is a generic term for describing an instance of a class. An object may be referenced by one or more pointers, which associate a name (such as <code>trainConductor</code> or <code>whiteRook</code>) with an object stored in memory.</p>

											<a name='EverythingIsAnObject'><h2>Everything is an object</h2></a>

											<p>Everything in Ozark is an object, even "primitive" types such as Integers and Booleans. Declaring an object literal (such as <code>5.3</code> or <code>true</code>) automatically allocates the memory space for the new object, and so you are able to pass messages to even the object literals (e.g. <code>5 + 3 -&gt; sum</code>)</p>

											<p>Objects are allocated manually with the <code>create</code> keyword when declaring a pointer, and then have a method called immediately using the semicolon (<code>;</code>) syntax.</p>

											<a name="Pointers"><h2>Objects are stored in pointers</h2></a>

											<p>When a <strong>pointer</strong> is set to an object, it maintains a reference to that object. If a pointer is set to another pointer, they are both then pointing to the same object. If that object's properties change, the difference will be reflected no matter from which pointer it is referenced.</p>

											<div class='code-sample-header'>ChessBoard.class.ozark</div>
											<div class='code-sample' itemscope itemtype="http://schema.org/Code"><meta itemprop="language" content="Ozark" /><pre>inheritance GameBoard

property @whitePieces: [ChessPiece]
property @blackPieces: [ChessPiece]

method setup
	create [ChessPiece]; set @whitePieces; setup | repeat 16 times
	create [ChessPiece]; set @blackPieces; setup | repeat 16 times

	create ChessRules; setupBoard white: @whitePieces, black: @blackPieces

method set whitePieces: [ChessPiece], blackPieces: [ChessPiece]
	set @whitePieces &lt;- whitePieces
	set @blackPieces &lt;- blackPieces</pre></div>

											<a name="Optionals"><h2>Optionals</h2></a>

											<p>There is no concept of "nil" - Instead, <span itemprop='name'>Ozark</span> uses <strong>optionals</strong> to denote pointers that are allowed to nave no value. Pointers marked as optional have limited capabilities, but can be unpacked for conditional usage with the <code>with</code> keyword.</p>

											<p>You can specify a property, input or output as optional by including a question mark (<code>?</code>) after the type.</p>

											<a name="Generics"><h2>Generics</h2></a>

											<p>Classes that manage objects of a generic type can be built with <strong>generics</strong>. These special types are included in the class definition.</p>

											<p>Types are separated from the class name and from each other by parenthesis <code>()</code></p>

											<div class='code-sample-header'>BinaryTree.class.ozark</div>
											<div class='code-sample' itemscope itemtype="http://schema.org/Code"><meta itemprop="language" content="Ozark" /><pre>inheritance Collection

type @Type

property @value: @Type
property @left: @Type
property @right: @Type</pre></div>

											<div class='code-sample-header'>TreeExample.class.ozark</div>
											<div class='code-sample' itemscope itemtype="http://schema.org/Code"><meta itemprop="language" content="Ozark" /><pre>inheritance Example

extension setup
	create btree: BinaryTree(Integer); setup values: [1,&nbsp;2,&nbsp;3,&nbsp;4,&nbsp;5]

	btree! index: 3 -> element: element
	print element</pre></div>
											<a name='BuiltInTypes'><h2>Built-In Types</h2></a>

											<p>There are 5 primary <strong>built-in types</strong> that come from the Ozark standard library: <code>Integer</code>, <code>Number</code>, <code>Boolean</code>, <code>Character</code>, and the user-defined <em>enumeration</em>.</p>

											<div class='alert alert-warning'>
												<p><span class='glyphicon glyphicon-alert'></span> <strong>Notice:</strong> Built-in types behave differently than other types.</p>
												<p>Assigning one of the 5 basic types with the <code>set</code> keyword creates a copy of the object, rather than having the new pointer reference the same object in memory.</p>
												<p>Also, you cannot create subclasses of the 5 built-in types.</p>
											</div>

											<a name='Integer'><h4>Integer</h4></a>

											<p>An <code>Integer</code> is the most basic of types. It's a number without a fractional component, like <code>0</code>, <code>3</code>, <code>4</code>, <code>-3</code>, or <code>10000</code>. Integers in Ozark are entered by default as decimals, but can be specified in binary with the prefix <code>0b</code> or in hexadecimal with the prefix <code>0x</code>. <code>0b1101</code> and <code>0x6A43</code> are examples of valid Integers in binary and hexadecimal, respectively.</p>

											<a name='Number'><h4>Number</h4></a>

											<p>A <code>Number</code> is the Ozark representation of a floating-point number, acting according to the <a href='https://en.wikipedia.org/wiki/IEEE_floating_point'>IEEE 754 standard</a>. A floating-point number is a number with a fractional component, such as <code>4.14</code>, <code>0.333</code>, or <code>-200.03</code>. By default, these appear in decimal, but are stored in binary, and are subject to common binary floating-point math characteristics. Like Integers, you can specify Number values in binary or hexadecimal using the <code>0b</code> and <code>0x</code> prefixes. <code>0b101101.1101</code> and <code>0x12F2.FF43</code> are examples of valid Numbers in binary and hexadecimal, respectively.</p>

											<p>A floating-point number has both a stored base, and a precision. The default base for a Number is 2, but you can also specify that a Number is in base 10 with the tick (<code>`</code>) symbol, like <code>property var1:Number`10</code> or <code>0.333`10</code>. This has much slower performance, and is only recommended for scenarios when modeling real-life decimal systems where decimal precision is important, like financial models.</p>

											<p>You can also specify a different precision for a Number using the degrees (<code>°</code>) symbol. The default precision is 32, but you can specify 64 and 128. <code>property var1:Number°128</code>, <code>1`10°64 / 3`10</code>.</p>

											<a name='Boolean'><h4>Boolean</h4></a>

											<p>A <code>Boolean</code> can only ever be true or false. Ozark provides two Boolean literals that represent the two values: <code>true</code> and <code>false</code>.</p>

											<a name='Character'><h4>Character</h4></a>

											<p>A <code>Character</code> is a single character from the Unicode character set. A Character literal is surrounded by single quotes, such as <code>'x'</code>, <code>'3'</code>, <code>'^'</code>, or <code>'🙉'</code>. You can also specify a unicode character with the <code>0u</code> prefix, followed by the unicode code point, like <code>0u0063</code>, which represents the latin lowercase letter "c".</p>

											<p>Ozark also has a <code>String</code> type, which is treated exactly as an <a href='collections#Arrays'>array</a> of Characters. To specify a string literal, surround the group of Characters with double quotes to denote a string, such as <code>"hello"</code>, <code>"1234"</code>, or <code>"wonderbread!!"</code>.</p>

											<p>The backslash <code>\</code> character is used as an escape character within strings. You can enter a backslash escaped by simply repeating it <code>\\</code>. Other control characters in a string must appear in source code in their escaped form, such as <code>\n</code> (newline) or <code>\t</code> (tab).</p>

											<a name='Enumeration'><h4>Enumeration</h4></a>

											<p>An <strong>enumeration</strong> is a value for which the possibilities are defined in advance. Enumerations are declared by the user, and can be nested within a class or can appear as a root-level file with the extension <code>.enumeration.ozark</code>. Enumerations follow the same naming convention as classes, and must have names unique from other classes and enumerations declared at the same level.</p>

											<p>Possible values for enumerations are declared with the <code>state</code> keyword, must start with a lowercase letter, and are referenced with dot notation.</p>

											<div class='code-sample-header'>Switch.enumeration.ozark</div>
											<div class='code-sample' itemscope itemtype="http://schema.org/Code"><meta itemprop="language" content="Ozark" /><pre>state forward
state off
state reverse</pre></div>

											<div class='code-sample-header'>ConveyorBelt.class.ozark</div>
											<div class='code-sample' itemscope itemtype="http://schema.org/Code"><meta itemprop="language" content="Ozark" /><pre>inheritance Machine

property @direction: Switch

method start
	set @direction &lt;- Switch.forward

method stop
	set @direction &lt;- Switch.off

method reverse
	set @direction &lt;- Switch.reverse</pre></div>
		
										<?php require('../includes/documentation-pagination.php'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php require('../includes/back-to-top.php'); ?>
		<?php require('../includes/bottom.php'); ?>
		<?php require('../includes/scripts.php'); ?>
	</body>
</html>