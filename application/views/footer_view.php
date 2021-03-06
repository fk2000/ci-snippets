<div id="footer">
実行時間：{elapsed_time}sec<br />
メモリ使用量：{memory_usage}
<!--/#footer--></div>

<script type="text/javascript" src="<?php echo base_url();?>js/shCore.js"></script>
<script src="<?php echo base_url();?>js/shAutoloader.js" type="text/javascript"></script>
<script type="text/javascript">
function path()
{
  var args = arguments,
      result = []
      ;

  for(var i = 0; i < args.length; i++)
		result.push(args[i].replace('@', '<?php echo base_url();?>js/'));

  return result
};
SyntaxHighlighter.autoloader.apply(null, path(
  'xml html               @shBrushXml.js',
  'applescript            @shBrushAppleScript.js',
  'actionscript3 as3      @shBrushAS3.js',
  'bash shell             @shBrushBash.js',
  'coldfusion cf          @shBrushColdFusion.js',
  'cpp c                  @shBrushCpp.js',
  'c# c-sharp csharp      @shBrushCSharp.js',
  'css                    @shBrushCss.js',
  'delphi pascal          @shBrushDelphi.js',
  'diff patch pas         @shBrushDiff.js',
  'erl erlang             @shBrushErlang.js',
  'groovy                 @shBrushGroovy.js',
  'java                   @shBrushJava.js',
  'jfx javafx             @shBrushJavaFX.js',
  'js jscript javascript  @shBrushJScript.js',
  'perl pl                @shBrushPerl.js',
  'php                    @shBrushPhp.js',
  'text plain             @shBrushPlain.js',
  'py python              @shBrushPython.js',
  'ruby rails ror rb      @shBrushRuby.js',
  'sass scss              @shBrushSass.js',
  'scala                  @shBrushScala.js',
  'sql                    @shBrushSql.js',
  'vb vbnet               @shBrushVb.js'
));

SyntaxHighlighter.all();
function deleteConfirm()
{
	if(window.confirm("#<?php echo $this->uri->segment(3);?>を削除しますか？"))
	{
		location.href = "<?php echo base_url();?>edit/delete"
	}
};
</script>
</body>
</html>
