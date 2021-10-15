const isProduction = process.env.NODE_ENV === 'production';
const isDevelopment = ! isProduction;

const PresetEnv = ( options = {} ) => {
	if ( typeof options.targets === 'undefined' ) {
		const browserslist = require( 'browserslist' );
		const localBrowserslistConfig = browserslist.findConfig( '.' ) || {};
		options.targets =
			localBrowserslistConfig.defaults || require( '@wordpress/browserslist-config' );
	}

	return [
		require.resolve( '@babel/preset-env' ),
		{
			// Exclude transforms that make all code slower, see https://github.com/facebook/create-react-app/pull/5278
			exclude: [ 'transform-typeof-symbol' ],
			...options,
		},
	];
};

const PresetReact = options => [ require.resolve( '@babel/preset-react' ), options ];

const PresetTypescript = options => [ require.resolve( '@babel/preset-typescript' ), options ];

const PluginProposalClassProperties = options => [
	require.resolve( '@babel/plugin-proposal-class-properties' ),
	options,
];

const PluginTransformRuntime = options => [
	require.resolve( '@babel/plugin-transform-runtime' ),
	{
		corejs: false, // We polyfill so we don't need core-js.
		regenerator: false,
		absoluteRuntime: true, // Required when workspace projects are symlinked.
		version: require( '@babel/runtime/package.json' )?.version,
		...options,
	},
];

const PluginCalypsoOptimizeI18n = options => [
	require.resolve( '@automattic/calypso-build/babel/babel-plugin-optimize-i18n' ),
	options,
];

// Note: For this cjs module to be used with named exports in an mjs context, modules.exports
// needs to contain only simple variables like `a` or `a: b`. Define anything more complex
// as a variable above, then use the variable here.
// @see https://github.com/nodejs/node/blob/master/deps/cjs-module-lexer/README.md#exports-object-assignment
module.exports = {
	isProduction,
	isDevelopment,

	PresetEnv,
	PresetReact,
	PresetTypescript,
	PluginProposalClassProperties,
	PluginTransformRuntime,
	PluginCalypsoOptimizeI18n,
};
