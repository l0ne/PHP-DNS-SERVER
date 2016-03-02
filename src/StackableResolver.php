<?php

namespace yswery\DNS;

class StackableResolver {

    /**
     * @var array
     */
    protected $resolvers;

    public function __construct(array $resolvers = array())
    {
        $this->resolvers = $resolvers;
    }

    public function get_answer($question, $ip, $port)
    {
        foreach ($this->resolvers as $resolver) {
            $answer = $resolver->get_answer($question);
            if ($answer) {
                $this->sendStats($answer, $ip, $port);
                return $answer;
            }
        }
        
        return array();
    }

}
