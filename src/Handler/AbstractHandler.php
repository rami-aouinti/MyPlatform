<?php

namespace App\Handler;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class AbstractHandler
 * @package App\Handler
 */
abstract class AbstractHandler implements HandlerInterface
{
    /**
     * @var FormFactoryInterface
     */
    private FormFactoryInterface $formFactory;

    /**
     * @var FormInterface
     */
    private FormInterface $form;


    /**
     * @return string
     */
    abstract protected function getFormType(): string;

    /**
     * @param $data
     * @return void
     */
    abstract protected function process($data): void;

    /**
     * @required
     * @param FormFactoryInterface $formFactory
     */
    public function setFormFactory(FormFactoryInterface $formFactory): void
    {
        $this->formFactory = $formFactory;
    }

    /**
     * @param Request $request
     * @param $data
     * @return bool
     */
    public function handle(Request $request, $data): bool
    {
        $this->form = $this->formFactory->create($this->getFormType(), $data)->handleRequest($request);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->process($data);
            return true;
        }

        return false;
    }

    /**
     * @inheritDoc
     */
    public function createView(): FormView
    {
        return $this->form->createView();
    }

}
