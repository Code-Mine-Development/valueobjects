<?php

namespace ValueObjects\Web;

use ValueObjects\String\String;
use ValueObjects\Util\Util;
use ValueObjects\ValueObjectInterface;

class Url implements ValueObjectInterface
{
    /** @var SchemeName */
    protected $scheme;

    /** @var String */
    protected $user;

    /** @var String */
    protected $password;

    /** @var Domain */
    protected $domain;

    /** @var Path */
    protected $path;

    /** @var PortNumber */
    protected $port;

    /** @var QueryString */
    protected $queryString;

    /** @var FragmentIdentifier */
    protected $fragmentIdentifier;

    /**
     * Returns a new Url object from a native url string
     *
     * @param $url_string
     * @return Url
     */
    public static function fromNative()
    {
        $urlString = \func_get_arg(0);

        $host        = \parse_url($urlString, PHP_URL_HOST);
        $queryString = \sprintf('?%s', \parse_url($urlString, PHP_URL_QUERY));
        $fragmentId  = \sprintf('#%s', \parse_url($urlString, PHP_URL_FRAGMENT));
        $port        = \parse_url($urlString, PHP_URL_PORT);

        $scheme     = new SchemeName(\parse_url($urlString, PHP_URL_SCHEME));
        $user       = new String(\parse_url($urlString, PHP_URL_USER));
        $pass       = new String(\parse_url($urlString, PHP_URL_PASS));
        $domain     = Domain::specifyType($host);
        $path       = new Path(\parse_url($urlString, PHP_URL_PATH));
        $portNumber = $port ? new PortNumber($port) : new NullPortNumber();
        $query      = new QueryString($queryString);
        $fragment   = new FragmentIdentifier($fragmentId);

        return new self($scheme, $user, $pass, $domain, $portNumber, $path, $query, $fragment);
    }

    /**
     * Returns a new Url object
     *
     * @param SchemeName          $scheme
     * @param String              $user
     * @param String              $password
     * @param Domain              $domain
     * @param Path                $path
     * @param PortNumberInterface $port
     * @param QueryString         $query
     * @param FragmentIdentifier  $fragment
     */
    public function __construct(SchemeName $scheme, String $user, String $password, Domain $domain, PortNumberInterface $port, Path $path, QueryString $query, FragmentIdentifier $fragment)
    {
        $this->scheme             = $scheme;
        $this->user               = $user;
        $this->password           = $password;
        $this->domain             = $domain;
        $this->path               = $path;
        $this->port               = $port;
        $this->queryString        = $query;
        $this->fragmentIdentifier = $fragment;
    }

    /**
     * Tells whether two Url are sameValueAs by comparing their components
     *
     * @param  ValueObjectInterface $url
     * @return bool
     */
    public function sameValueAs(ValueObjectInterface $url)
    {
        if (false === Util::classsameValueAs($this, $url)) {
            return false;
        }

        return $this->getScheme()->sameValueAs($url->getScheme()) &&
               $this->getUser()->sameValueAs($url->getUser()) &&
               $this->getPassword()->sameValueAs($url->getPassword()) &&
               $this->getDomain()->sameValueAs($url->getDomain()) &&
               $this->getPath()->sameValueAs($url->getPath()) &&
               $this->getPort()->sameValueAs($url->getPort()) &&
               $this->getQueryString()->sameValueAs($url->getQueryString()) &&
               $this->getFragmentIdentifier()->sameValueAs($url->getFragmentIdentifier())
        ;
    }

    /**
     * Returns the domain of the Url
     *
     * @return Hostname|IPAddress
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Returns the fragment identifier of the Url
     *
     * @return FragmentIdentifier
     */
    public function getFragmentIdentifier()
    {
        return $this->fragmentIdentifier;
    }

    /**
     * Returns the password part of the Url
     *
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the path of the Url
     *
     * @return Path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns the port of the Url
     *
     * @return PortNumberInterface
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Returns the query string of the Url
     *
     * @return QueryString
     */
    public function getQueryString()
    {
        return $this->queryString;
    }

    /**
     * Returns the scheme of the Url
     *
     * @return SchemeName
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Returns the user part of the Url
     *
     * @return String
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns a string representation of the url
     *
     * @return string
     */
    public function __toString()
    {
        $userPass = '';
        if (false == $this->getUser()->isEmpty()) {
            $userPass = \sprintf('%s@', $this->getUser());

            if (false == $this->getPassword()->isEmpty()) {
                $userPass = \sprintf('%s:%s@', $this->getUser(), $this->getPassword());
            }
        }

        $port = '';
        if (false == NullPortNumber::create()->sameValueAs($this->getPort())) {
            $port = \sprintf(':%d', $this->getPort()->toNative());
        }

        $urlString = \sprintf('%s://%s%s%s%s%s%s', $this->getScheme(), $userPass, $this->getDomain(), $port, $this->getPath(), $this->getQueryString(), $this->getFragmentIdentifier());

        return $urlString;
    }
}
