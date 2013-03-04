<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	<h3>Calculadora</h3>
</div>
<div class="modal-body">
	<form name="Keypad">
		<table >
		<tr>
			<td colspan=3 align=middle>
				<input name="ReadOut" type="Text" size=24 value="0" width=100% onFocus="self.focus(;">
			</td>
			<td width=4 rowspan=5>&nbsp;</td>
			<td align=center><div onclick="Clear();">
				<a class="btn btn-large btn-block">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>C</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
				</div>
			</td>
			<td align=left><div onclick="ClearEntry();">
				<a class="btn btn-large btn-block">&nbsp;&nbsp;&nbsp;&nbsp;C<u>E</u>&nbsp;&nbsp;&nbsp;&nbsp;</a>
				</div>
			</td>
		</tr>
		<tr>
			<td align=left><div onclick="NumPressed(7);">
				<a class="btn btn-large btn-block">7</a>
				</div>
			</td>
			<td align=center><div onclick="NumPressed(8);">
				<a class="btn btn-large btn-block">8</a>
				</div>
			</td>
			<td align=right><div onclick="NumPressed(9);">
				<a class="btn btn-large btn-block">9</a>
				</div>
			</td>
			<td align=center><div onclick="Neg();">
				<a class="btn btn-large btn-block">+/-</a>
				</div>
			</td>
			<td align=center><div onclick="Percent();">
				<a class="btn btn-large btn-block">0/0</a>
				</div>
			</td>
		</tr>
		<tr>
			<td align=left><div onclick="NumPressed(4);">
				<a class="btn btn-large btn-block">4</a>
				</div>
			</td>
			<td align=center><div onclick="NumPressed(5);">
				<a class="btn btn-large btn-block">5</a>
				</div>
			</td>
			<td align=right><div onclick="NumPressed(6);">
				<a class="btn btn-large btn-block">6</a>
				</div>
			</td>
			<td align=right><div onclick="Operation('+');">
				<a class="btn btn-large btn-block">+</a>
				</div>
			</td>
			<td align=right><div onclick="Operation('-');">
				<a class="btn btn-large btn-block">-</a>
				</div>
			</td>
		</tr>
		<tr>
			<td align=left><div onclick="NumPressed(1);">
				<a class="btn btn-large btn-block">1</a>
				</div>
			</td>
			<td align=center><div onclick="NumPressed(2);">
				<a class="btn btn-large btn-block">2</a>
				</div>
			</td>
			<td align=right><div onclick="NumPressed(3);">
				<a class="btn btn-large btn-block">3</a>
				</div>
			</td>
			<td align=center><div onclick="Operation('*');">
				<a class="btn btn-large btn-block">*</a>
				</div>
			</td>
			<td align=center><div onclick="Operation('/');">
				<a class="btn btn-large btn-block">/</a>
				</div>
			</td>
		</tr>
		<tr>
			<td align=left><div onclick="NumPressed(0);">
				<a class="btn btn-large btn-block">0</a>
				</div>
			</td>
			<td align=center><div onclick="Decimal();">
				<a class="btn btn-large btn-block">.</a>
				</div>
			</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
			<td align=center><div onclick="Operation('=');">
				<a class="btn btn-large btn-block">=</a>
				</div>
			</td>
		</tr>
		</table>
	</form>
</div>
<div class="modal-footer">
	<a href="#" class="btn btn-large btn-block" data-dismiss="modal">Fechar</a>
</div>

		<style type="text/css">
			body .modal {
			    /* new custom width */
			    width: 400px;
			    /* must be half of the width, minus scrollbar on the left (30px) */
			    margin-left: -280px;
			}
		</style>


<script language="JavaScript">
	function check_keypress (e)
	{
		var keycode = ( window.Event ) ? e.which : event.keyCode;

		var zero_key = 48;
		var nine_key = 57;
		var decimal_key = 46;

		var C_key = 67;
		var E_key = 69;
		var M_key = 77;
		var P_key = 80;

		var plus_key = 43;
		var minus_key = 45;
		var multiply_key = 42;
		var divide_key = 47;
		var percent_key = 37;
		var cr_key = 13;
		var del_key = 44;
		var equals_key = 61;

		// CONVERT CHARACTER KEYS TO UPPER CASE
		if ( keycode >= 97 && keycode <= 122 )
			keycode -= 32;

		if ( keycode >= zero_key && keycode <= nine_key ) {
			var Num = keycode - zero_key;
			NumPressed ( Num );
			return ( false );
		}
		else if ( keycode == decimal_key ) {
			Decimal ();
			return ( false );
		}
		else if ( keycode == equals_key || keycode == cr_key ) {
			Operation ( "=" );
			return ( false );
		}
		else if ( keycode == plus_key ) {
			Operation ( "+" );
			return ( false );
		}
		else if ( keycode == minus_key ) {
			Operation ( "-" );
			return ( false );
		}
		else if ( keycode == multiply_key ) {
			Operation ( "*" );
			return ( false );
		}
		else if ( keycode == divide_key ) {
			Operation ( "/" );
			return ( false );
		}
		else if ( keycode == percent_key ) {
			Percent ();
			return ( false );
		}
		else if ( keycode == C_key || keycode == del_key) {
			Clear ();
			return ( false );
		}
		else if ( keycode == E_key ) {
			ClearEntry ();
			return ( false );
		}
		else if ( keycode == M_key || keycode == P_key ) {
			Neg ();
			return ( false );
		}

		return ( true );
	}

	var bName = navigator.appName.substring ( 0, 3 );
	document.onkeypress = check_keypress;
	if ( bName == "Net" )
		document.captureEvents ( Event.KEYPRESS );
	// Module-level variables
	var Accum = 0;				// Previous number (operand) awaiting operation
	var FlagNewNum = false;		// Flag to indicate a new number (operand) is being entered
	var PendingOp = "";			// Pending operation waiting for completion of second operand
	function NumPressed ( Num )
	{
		var calculator = document.Keypad;
		if (FlagNewNum)	{
			calculator.ReadOut.value  = Num;
			FlagNewNum = false;
		}
		else {
			if ( calculator.ReadOut.value == "0" )
				calculator.ReadOut.value = Num;
			else
				calculator.ReadOut.value += Num;
		}
	}

	function Operation ( Op )
	{
		var calculator = document.Keypad;
		//alert( 'op' );
		if ( FlagNewNum && PendingOp != "=" );
			// User is hitting op keys repeatedly, so don't do anything
		else {
			//alert( PendingOp );
			FlagNewNum = true;

			if ( '+' == PendingOp )
				Accum += parseFloat ( calculator.ReadOut.value );
			else if ( '-' == PendingOp )
				Accum -= parseFloat ( calculator.ReadOut.value );
			else if ( '/' == PendingOp )
				Accum /= parseFloat ( calculator.ReadOut.value );
			else if ( '*' == PendingOp )
				Accum *= parseFloat ( calculator.ReadOut.value );
			else
				Accum = parseFloat ( calculator.ReadOut.value );
			calculator.ReadOut.value = Accum;
			PendingOp = Op;
		}
	}

	function Decimal ()
	{
		var calculator = document.Keypad;
		if (FlagNewNum) {
			calculator.ReadOut.value = "0.";
			FlagNewNum = false;
		}
		else {
			if ( calculator.ReadOut.value.indexOf ( "." ) == -1 )
				calculator.ReadOut.value += ".";
		}
	}


	function ClearEntry ()
	{
		var calculator = document.Keypad;
		// Remove current number and reset state
		calculator.ReadOut.value = "0";
		FlagNewNum = true;
	}


	function Clear ()
	{
		// Clear accumulator and pending operation, and clear display
		Accum = 0;
		PendingOp = "";
		ClearEntry ();
	}

	function Neg ()
	{
		var calculator = document.Keypad;
		calculator.ReadOut.value = parseFloat ( calculator.ReadOut.value ) * -1;
	}

	function Percent ()
	{
		var calculator = document.Keypad;
		calculator.ReadOut.value = ( parseFloat ( calculator.ReadOut.value ) / 100) * parseFloat ( Accum );
	}
</script>