<?php
/*

Copyright (c) 2009, Symbiote PTY LTD - www.symbiote.com.au
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    * Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
    * Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the
      documentation and/or other materials provided with the distribution.
    * Neither the name of SilverStripe nor the names of its contributors may be used to endorse or promote products derived from this software
      without specific prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE
GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY
OF SUCH DAMAGE.
*/

/**
 * A select field that takes its inputs from a data list
 *
 * @author Marcus Nyeholt <marcus@symbiote.com.au>
 */
class DynamicListField extends DropdownField {
    function __construct($name, $title = null, $source = null, $value = "", $form = null, $emptyString = null) {
		if (!$source) {
			$source = array();
		}

		if (is_string($source)){
			// it should be the name of a list, lets get all its contents
			$dynamicList = DataObject::get_one('DynamicList', '"Title" = \''.Convert::raw2sql($source).'\'');
			$source = array();
			if ($dynamicList) {
				$items = $dynamicList->Items();
				foreach ($items as $item) {
					$source[$item->Title] = $item->Title;
				}
			}
		}

		parent::__construct($name, $title, $source, $value, $form, $emptyString);
	}
}