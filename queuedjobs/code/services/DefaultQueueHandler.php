<?php

/**
 * Default method for handling items run via the cron
 *
 * @author marcus@symbiote.com.au
 * @license BSD License http://silverstripe.org/bsd-license/
 */
class DefaultQueueHandler {
	public function startJobOnQueue(QueuedJobDescriptor $job) {
		$job->activateOnQueue();
	}
}
