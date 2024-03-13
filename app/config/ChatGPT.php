<?php

return [

	/**
	--------------------------------------------------------------------------
	  API KEY OF CHATGPT
	--------------------------------------------------------------------------
	 * 
	 * The ChatGPT API key is used to authenticate access to the API. 
	 * @var string
	 */
	'apikey' => 'your_apikey_here',

	/**
	--------------------------------------------------------------------------
	  URL KEY OF CHATGPT
	--------------------------------------------------------------------------
	 * 
	 * The url of the openAI api
	 * @var string
	 */
	'apiUrl' => 'https://api.openai.com/v1/completions',

	/**
	--------------------------------------------------------------------------
	  MODEL OF CHATGPT
	--------------------------------------------------------------------------
	 * 
	 * The ChatGPT model is used to generate text.
	 * @var string
	 */
	'model' => 'text-davinci-003',

	/**
	--------------------------------------------------------------------------
	  MAX TOKENS
	--------------------------------------------------------------------------
	 * 
	 * The maximum number of tokens to generate in the response. Optional, 
	 * defaults to 400.
	 * @var int
	 */
	'max_tokens' => 400,

	/**
	--------------------------------------------------------------------------
	  TEMPERATURE
	--------------------------------------------------------------------------
	 * 
	 *  Controls the "creativity" of the model. Optional, defaults to 0.0.
	 * @var float
	 */
	'temperature' => 0.0,

	/**
	--------------------------------------------------------------------------
	  TOP
	--------------------------------------------------------------------------
	 *
	 * Controls the probability of generating the most probable word.
	 * Optional, defaults to 1.0.
	 * @var float
	 */
	'top_p' => 1.0,

	/**
	--------------------------------------------------------------------------
	  FRECUENCY PENALTY
	--------------------------------------------------------------------------
	 *
	 * Penalizes the generation of words that appear frequently in the training text. 
	 * Optional, defaults to 0.0.
	 * @var float
	 */
	'frequency_penalty' => 0.0,

	/**
	--------------------------------------------------------------------------
	  PRESENCE PENALTY
	--------------------------------------------------------------------------
	 *
	 * Penalizes the generation of words that appear frequently in the input text.
	 * Optional, defaults to 0.0.
	 * @var float
	 */
	'presence_penalty' => 0.0,

	/**
	--------------------------------------------------------------------------
	  N
	--------------------------------------------------------------------------
	 *
	 * The number of responses to generate. Optional, defaults to 1.
	 * @var int
	 */
	'n' => 1
];
