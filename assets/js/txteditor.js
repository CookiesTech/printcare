// JavaScript Document


// The instanceReady event is fired, when an instance of CKEditor has finished
// its initialization.
CKEDITOR.on( 'instanceReady', function( ev ) {
	// Show the editor name and description in the browser status bar.
	//document.getElementById( 'eMessage' ).innerHTML = 'Instance <code>' + ev.editor.name + '<\/code> loaded.';

	// Show this sample buttons.
	//document.getElementById( 'eButtons' ).style.display = 'block';
});

function InsertHTML() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;

	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
		// Insert HTML code.
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml
		editor.insertHtml( value );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function InsertText() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'txtArea' ).value;

	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
		// Insert as plain text.
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertText
		editor.insertText( value );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function SetContents() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	var value = document.getElementById( 'htmlArea' ).value;

	// Set editor contents (replace current contents).
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-setData
	editor.setData( value );
}

function GetContents() {
	// Get the editor instance that you want to interact with.
	var editor = CKEDITOR.instances.editor1;

	// Get editor contents
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData
	alert( editor.getData() );
}

function ExecuteCommand( commandName ) {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;

	// Check the active editing mode.
	if ( editor.mode == 'wysiwyg' )
	{
		// Execute the command.
		// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-execCommand
		editor.execCommand( commandName );
	}
	else
		alert( 'You must be in WYSIWYG mode!' );
}

function CheckDirty() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Checks whether the current editor contents present changes when compared
	// to the contents loaded into the editor at startup
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-checkDirty
	alert( editor.checkDirty() );
}

function ResetDirty() {
	// Get the editor instance that we want to interact with.
	var editor = CKEDITOR.instances.editor1;
	// Resets the "dirty state" of the editor (see CheckDirty())
	// http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-resetDirty
	editor.resetDirty();
	alert( 'The "IsDirty" status has been reset' );
}

function Focus() {
	CKEDITOR.instances.editor1.focus();
}

function onFocus() {
	//document.getElementById( 'eMessage' ).innerHTML = '<b>' + this.name + ' is focused </b>';
}

function onBlur() {
	if ( this.mode == 'source' )
	{
		input = this.getData();
		input = input.replace('<script',"");
		input = input.replace('<SCRIPT',"");
		input = input.replace('.php',"");
		input = input.replace('.PHP',"");
		input = input.replace('.html',"");
		input = input.replace('.HTML',"");
		input = input.replace('.js',"");
		input = input.replace('.JS',"");
		input = input.replace('.xml',"");
		input = input.replace('.XML',"");
		input = input.replace('<link',"");
		input = input.replace('<LINK',"");
		input = input.replace('http:',"");
		input = input.replace('HTTP:',"");
		input = input.replace('https:',"");
		input = input.replace('HTTPS:',"");
		input = input.replace('href',"");
		input = input.replace('HREF',"");
		input = input.replace('<a',"");
		input = input.replace('<A',"");
		input = input.replace('</script',"");	
		input = input.replace('</SCRIPT',"");		
		this.setData(input);
	}
	//document.getElementById( 'eMessage' ).innerHTML = this.name + ' lost focus';
}
function onKeyup() {
	if ( this.mode == 'source' )
	{
		input = this.getData();
		input = input.replace('<script',"");
		input = input.replace('<SCRIPT',"");
		input = input.replace('.php',"");
		input = input.replace('.PHP',"");
		input = input.replace('.html',"");
		input = input.replace('.HTML',"");
		input = input.replace('.js',"");
		input = input.replace('.JS',"");
		input = input.replace('.xml',"");
		input = input.replace('.XML',"");
		input = input.replace('<link',"");
		input = input.replace('<LINK',"");
		input = input.replace('http:',"");
		input = input.replace('HTTP:',"");
		input = input.replace('https:',"");
		input = input.replace('HTTPS:',"");
		input = input.replace('href',"");
		input = input.replace('HREF',"");
		input = input.replace('<a',"");
		input = input.replace('<A',"");
		input = input.replace('</script',"");	
		input = input.replace('</SCRIPT',"");		
		this.setData(input);
	}
}
