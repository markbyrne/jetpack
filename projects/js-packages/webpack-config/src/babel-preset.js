const babelConfig = require( './babel' );

module.exports = () => ( {
	sourceType: 'unambiguous',
	presets: [ babelConfig.PresetEnv(), babelConfig.PresetReact(), babelConfig.PresetTypescript() ],
	plugins: [
		babelConfig.PluginProposalClassProperties(),
		babelConfig.PluginTransformRuntime(),
		babelConfig.PluginCalypsoOptimizeI18n(),
	],
} );
