Coding Standards
================

### General Standards

- Tabs should always be 4 spaces wide.

### PHP

In files that are "purely" php (i.e., the very top line of the file is `<?php` and the very last is `?>`, with no HTML code in between), the document should be formatted as follows:

- Any time you create a new block using `{}`, you should indent all code inside of the block.
- Any code not contained inside any `{}` should not be indented, for example
	```
	<?php

	class Foo {
		// ...
	}

	?>
	```
- All `if`s, `for`s, `while`s, and `foreach`es must use `{}`, even if the body is only one line long.
- The opening brace, `{`, must be at the end of the line with one space before it. For example
	```
	if (condition) { // curly brace is at end here
		doSomething();
	}
	```
- The closing brace, '}', must be aligned with the block that it closes, as in the above example.
- All comments should have a space between the `//` and the text. So `// comment` is fine, but `//comment` is not.
- There must be an extra line with no text on it between functions/comments describing them, e.g.
	```
	// description of foo
	function foo() {
		// function code
	}

	// description of bar
	function bar() {
		// function code
	}
- There should be white space surrounding all arithmetic operators, so `1 + 2` is fine while `1+2` is not.
- At the programmers discretion, empty lines may be added between chunks of code in the body of a function to separate ideas or make it more legible.
- No line should be wider than 80 characters. If a line must be broken up, use a hanging indent.
- Any JavaScript files or code that is written should follow the same standards set forth for PHP.

### HTML

HTML documents include any document that includes the `<html>` and `</html>` tags. Here are the formatting standards:

- The `<html>`, `<head>`, and `<body>` tags should all be aligned to the left margin.
- The closing tag must line up vertically with the opening tag, or, if the inner html is empty, be on the same line.
- The body of any non-empty tag must begin on a new line and, with the exception of tags directly under `<html>`, be indented.
- When PHP or JavaScript is embedded within an HTML, the code must be indented from the tag. So in a "pure" PHP file, this is the standard:
	```
	<?php

	// code
	
	?>
	```
	But inside of an HTML document, this is:
	<?php
		// code
	?>
- At the programmers discretion, empty lines may be added between chunks of HTML to separate different ideas or make the code more legible.

### CSS

The CSS coding standards apply both to `.css` documents and CSS code inside of an HTML document. Here are the standards:

- Much like in PHP and JavaScript, the opening `{` must be on the end of the line that starts the block.
- There should be a space after every `:`, e.g. `color: red`.
- There should never be CSS written in-line with an HTML tag.