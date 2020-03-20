<?php
/**
 * JBZoo Application
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package    Application
 * @license    GPL-2.0
 * @copyright  Copyright (C) JBZoo.com, All rights reserved.
 * @link       https://github.com/JBZoo/JBZoo
 * @author     Denis Smetannikov <denis@jbzoo.com>
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

$url = $_SERVER['SERVER_NAME'];

?>

<table class="es-wrapper">
    <tbody>
    <tr>
        <td class="esd-email-paddings" style="padding: 0;">
            <table class="es-content" style="width: 100%">
                <tbody>
                <tr></tr>
                <tr>
                    <td class="esd-stripe" style="padding: 0;">
                        <table class="es-header-body" style="background-color: #044767; width: 100%">
                            <tbody>
                            <tr>
                                <td class="esd-structure" style="width: 100%; padding: 35px 10px;">
                                    <table style="width: 100%">
                                        <tbody>
                                        <tr>
                                            <td class="esd-container-frame" style="padding: 0 10px;">
                                                <table style="width: 100%; float: left">
                                                    <tbody>
                                                    <tr>
                                                        <td class="esd-block-text" style="padding: 0 10px;">
                                                            <h1 style="margin: 0">
                                                                <a style="color: #ffffff; font-size: 14px; text-decoration: none;"
                                                                   href="<?= $url ?>">
                                                                    <?php if ($this->checkPosition('title')) : ?>
                                                                        <?php echo $this->renderPosition('title'); ?>
                                                                    <?php endif; ?>
                                                                </a>
                                                            </h1>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="esd-structure" style="width: 100%; padding: 35px 10px;">
                                    <table style="width: 100%">
                                        <tbody>
                                        <tr class="es-hidden">
                                            <td class="es-m-p20b" style="padding: 0 10px;">
                                                <table style="width: 100%; float: right">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            <table style="width: 100%; float: right; text-align: right;">
                                                                <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <a style="color: #ffffff; font-size: 14px;"
                                                                           href="<?= $url ?>/contacts">Контакты</a>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="es-content" style="width: 100%">
                <tbody>
                <tr>
                    <td class="esd-stripe" style="padding: 0 10px;">
                        <table class="es-content-body" style="margin-right: auto; margin-left: auto">
                            <tbody>
                            <tr>
                                <td class="esd-structure" style="padding: 0 10px">
                                    <table style="width: 100%">
                                        <tbody>
                                        <tr>
                                            <td class="esd-container-frame" style="padding: 0;">
                                                <table style="width: 100%">
                                                    <tbody>
                                                    <tr>
                                                        <td class="esd-block-image"
                                                            style="display: block; text-align: center; padding: 15px;">
                                                            <img style="margin: auto;"
                                                                 src="data:image/svg+xml;base64,PHN2Zw0KCQl3aWR0aD0iMTAwcHgiDQoJCXZlcnNpb249IjEuMSINCgkJdmlld0JveD0iMCAwIDUxMiA1MTIiDQoJCXhtbDpzcGFjZT0icHJlc2VydmUiDQoJCXhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyINCgkJeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiDQo+DQoJPGc+DQoJCTxnPg0KCQkJPGNpcmNsZSBzdHlsZT0iZmlsbDogIzM0QjI5NzsiIGN4PSIyNTYiIGN5PSIyNTYiDQoJCQkJCXI9IjI1MCIvPg0KCQk8L2c+DQoJCTxwYXRoIHN0eWxlPSJmaWxsOiAjMTVBMDg1OyINCgkJCSAgZD0iTTUwNiwyNTkuN2MtMC4yLTAuMy0wLjQtMC41LTAuNy0wLjhjLTM2LTM1LjktNzEuOS03MS44LTEwNy44LTEwNy43Yy0xLjEtMS4xLTIuMi0yLjEtMy4zLTMuMSAgIGMtNy44LTYuNS0xNy05LjEtMjctOC4xYy04LjUsMC45LTE1LjgsNC43LTIxLjksMTAuOGMtNDMsNDMuMS04Ni4xLDg2LjEtMTI5LjEsMTI5LjJjLTIuMSwyLTEuNSwyLjEtMy42LDAgICBjLTE0LjgtMTQuOC0yOS42LTI5LjctNDQuNS00NC40Yy05LjYtOS41LTIxLjItMTIuNy0zNC4zLTkuN2MtMTUsMy40LTI2LjQsMTcuNC0yNywzMi44Yy0wLjQsMTAuOSwzLjQsMjAuMSwxMS4xLDI3LjggICBDMTg3LjMsMzU2LDI1Ni44LDQyNS41LDMyNi4yLDQ5NWMwLjMsMC4zLDAuNiwwLjYsMC45LDAuN0M0MjkuNCw0NjUuNCw1MDQuMywzNzEuNSw1MDYsMjU5Ljd6Ii8+DQoJCTxwYXRoIHN0eWxlPSJmaWxsOiAjRkZGRkZGOyINCgkJCSAgZD0iTTIxMy41LDM3Mi42Yy02LDAtMTIuMS0yLjMtMTYuNy02LjlsLTgwLjQtODAuNGMtMTMuOS0xMy45LTEzLjktMzYuNSwwLTUwLjRjMTMuOS0xMy45LDM2LjUtMTMuOSw1MC40LDAgICBsNDYuNyw0Ni43bDEzMS43LTEzMS43bDAsMGMxMy45LTEzLjksMzYuNS0xMy45LDUwLjQsMGMxMy45LDEzLjksMTMuOSwzNi41LDAsNTAuNEwyMzAuMiwzNjUuNiAgIEMyMjUuNiwzNzAuMywyMTkuNiwzNzIuNiwyMTMuNSwzNzIuNnogTTE0MS42LDI0Mi43Yy00LjQsMC04LjksMS43LTEyLjMsNS4xYy02LjgsNi44LTYuOCwxNy44LDAsMjQuNmw4MC40LDgwLjQgICBjMi4xLDIuMSw1LjUsMi4xLDcuNiwwbDE2NS40LTE2NS40YzYuOC02LjgsNi44LTE3LjgsMC0yNC42Yy02LjgtNi44LTE3LjgtNi44LTI0LjYsMGwtMTMzLDEzM2MtMy4xLDMuMS03LjIsNC44LTExLjYsNC44ICAgYy00LjQsMC04LjUtMS43LTExLjYtNC44bC00OC00OEMxNTAuNSwyNDQuNCwxNDYuMSwyNDIuNywxNDEuNiwyNDIuN3oiLz4NCgk8L2c+DQo8L3N2Zz4="/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esd-block-text" style="padding: 0 10px">
                                                            <h2 style="text-align: center">
                                                                <?php if ($this->checkPosition('thankyou')) : ?>
                                                                    <?php echo $this->renderPosition('thankyou'); ?>
                                                                <?php else: ?>
                                                                    Спасибо за ваш заказ!
                                                                <?php endif; ?>
                                                            </h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="esd-block-text" style="padding: 0">
                                                            <p style="font-size: 16px; color: #777777; text-align: center">
                                                                Наши менеджеры свяжутся с вами в ближайшее время
                                                                <br>
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="es-content" style="width: 100%;">
                <tbody>
                <tr>
                    <td class="esd-stripe" style="padding: 0 10px;">
                        <table class="es-content-body" style="width: 100%;">
                            <tbody>
                            <tr>
                                <td class="esd-structure" style="padding: 0">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td class="esd-container-frame" style="padding: 0 10px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr>
                                                        <td class="esd-block-text" style="padding: 10px">
                                                            <table class="cke_show_border" style="width: 100%;">
                                                                <tbody>
                                                                <tr class="">
                                                                    <td style="text-align: center; padding: 0 10px;">
                                                                        <h4>
                                                                            Заказ #
                                                                            <?php if ($this->checkPosition('ordernumber')) : ?>
                                                                                <?php echo $this->renderPosition('ordernumber'); ?>
                                                                            <?php endif; ?>
                                                                            от
                                                                            <span>
                                                                                 <?php if ($this->checkPosition('date')) : ?>
                                                                                     <?php echo $this->renderPosition('date'); ?>
                                                                                 <?php endif; ?>
                                                                            </span>
                                                                        </h4>
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="esd-structure" style="padding: 0">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td class="esd-container-frame" style="padding: 0 10px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr>
                                                        <td class="esd-block-text" style="padding: 0">
                                                            <?php echo $this->renderPosition('body'); ?>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="esd-structure" style="padding: 10px 0; width: 100%">
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="width: 49%; vertical-align: top; padding: 0 10px">
                                                <table style="width: 100%; float: left">
                                                    <?php if ($this->checkPosition('delivery')) : ?>
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-container-frame"
                                                                style="padding: 0;">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="esd-block-text"
                                                                            style="padding: 0 0 15px 0;">
                                                                            <h2>Данные о доставке</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="esd-block-text"
                                                                            style="padding: 0 0 10px 0;">
                                                                            <?php echo $this->renderPosition('delivery'); ?>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    <?php endif; ?>
                                                </table>
                                            </td>
                                            <td style="width: 49%; vertical-align: top; padding: 0 10px">
                                                <table style="width: 100%;">
                                                    <?php if ($this->checkPosition('client')) : ?>
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-container-frame">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="esd-block-text"
                                                                            style="padding: 0 0 15px 0;">
                                                                            <h2>Информация о клиенте</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="esd-block-text">
                                                                            <?php echo $this->renderPosition('client'); ?>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    <?php endif; ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td class="esd-structure" style="padding: 0; width: 100%">
                                    <table style="width: 100%">
                                        <tr>
                                            <td style="width: 49%; vertical-align: top; padding: 0 10px">
                                                <table style="width: 100%;">
                                                    <?php if ($this->checkPosition('payment')) : ?>
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-container-frame">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="esd-block-text"
                                                                            style="padding: 0 0 15px 0;">
                                                                            <h2>Данные об оплате</h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="esd-block-text">
                                                                            <?php echo $this->renderPosition('payment'); ?>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    <?php endif; ?>
                                                </table>
                                            </td>
                                            <td style="width: 49%; vertical-align: top; padding: 0 10px">
                                                <table style="width: 100%;">
                                                    <?php if ($this->checkPosition('shopinfo')) : ?>
                                                        <tbody>
                                                        <tr>
                                                            <td class="esd-container-frame">
                                                                <table style="width: 100%;">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="esd-block-text"
                                                                            style="padding: 0 0 15px 0;">
                                                                            <h2>Контакты магазина<br></h2>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="esd-block-text">
                                                                            <?php echo $this->renderPosition('shopinfo'); ?>
                                                                        </td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    <?php endif; ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="es-footer" style="width: 100%">
                <tbody>
                <tr>
                    <td class="esd-stripe" style="padding: 0 10px;">
                        <table class="es-footer-body" style="width: 100%; margin-left: auto; margin-right: auto">
                            <tbody>
                            <tr>
                                <td class="esd-structure" style="padding: 0;">
                                    <table style="width: 100%;">
                                        <tbody>
                                        <tr>
                                            <td class="esd-container-frame" style="padding: 0 10px;">
                                                <table style="width: 100%;">
                                                    <tbody>
                                                    <tr>
                                                        <td class="esd-block-image"
                                                            style="text-align: center; padding: 0 0 15px 0">
                                                            <a target="_blank" href="<?= $url ?>">
                                                                <img
                                                                        style="display: block; text-align: center; margin-left: auto; margin-right: auto"
                                                                        src="<?= $url ?>/images/logo.png"
                                                                        alt="<?= $this->renderPosition('title'); ?>"
                                                                >
                                                            </a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="esd-block-text"
                                                            style="padding: 0 0 5px 0; text-align: center">
                                                            <p style="color: #777777;">
                                                                Если вы ничего не заказывали на нашем сайте, пожалуйста
                                                                просто проигнорируйте это письмо
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    </tbody>
</table>
<style>
    /* CONFIG STYLES Please do not delete and edit CSS styles below */
    /* IMPORTANT THIS STYLES MUST BE ON FINAL EMAIL */


    #outlook a {
        padding: 0;
    }


    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
        line-height: 100%;
    }

    a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /*
    END OF IMPORTANT
    */
    s {
        text-decoration: line-through;
    }

    html,
    body {
        width: 100%;
        font-family: 'open sans', 'helvetica neue', helvetica, arial, sans-serif;
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }

    table {
        mso-table-lspace: 0;
        mso-table-rspace: 0;
        border-collapse: collapse;
        border-spacing: 0;
    }

    th {
        white-space: nowrap;
    }


    /*table td {
        padding: 0 10px;
    }*/


    html,
    body,
    .es-wrapper {
        padding: 0;
        margin: 0;
    }

    .es-content,
    .es-footer {
        table-layout: fixed !important;
        width: 100%;
    }

    img {
        display: block;
        border: 0;
        outline: none;
        text-decoration: none;
        -ms-interpolation-mode: bicubic;
    }

    table tr {
        border-collapse: collapse;
    }

    p,
    hr {
        Margin: 0;
    }

    h1,
    h2,
    h3,
    h4,
    h5 {
        Margin: 0;
        line-height: 120%;
        mso-line-height-rule: exactly;
        font-family: 'open sans', 'helvetica neue', helvetica, arial, sans-serif;
    }

    p,
    ul li,
    ol li,
    a {
        -webkit-text-size-adjust: none;
        -ms-text-size-adjust: none;
        mso-line-height-rule: exactly;
    }


    .es-menu td {
        border: 0;
    }

    .es-menu td a img {
        display: inline-block !important;
    }

    /* END CONFIG STYLES */
    a {
        font-family: 'open sans', 'helvetica neue', helvetica, arial, sans-serif;
        font-size: 16px;
        text-decoration: none;
    }

    h1 {
        font-size: 36px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
    }

    h1 a {
        font-size: 36px;
    }

    h2 {
        font-size: 30px;
        font-style: normal;
        font-weight: bold;
        color: #333333;
    }

    h2 a {
        font-size: 30px;
    }

    h3 {
        font-size: 18px;
        font-style: normal;
        font-weight: normal;
        color: #333333;
    }

    h3 a {
        font-size: 18px;
    }

    p,
    ul li,
    ol li {
        font-size: 16px;
        font-family: 'open sans', 'helvetica neue', helvetica, arial, sans-serif;
        line-height: 150%;
    }

    ul li,
    ol li {
        margin-bottom: 15px;
    }

    .es-menu td a {
        text-decoration: none;
        display: block;
    }

    .es-wrapper {
        width: 100%;
        height: 100%;
        background-image: ;
        background-repeat: repeat;
        background-position: center top;
    }

    .es-content-body {
        background-color: #ffffff;
    }

    .es-content-body p,
    .es-content-body ul li,
    .es-content-body ol li {
        color: #333333;
    }

    .es-content-body a {
        color: #ed8e20;
    }

    .es-header-body {
        background-color: #044767;
        width: 100%;
    }

    .es-header-body p,
    .es-header-body ul li,
    .es-header-body ol li {
        color: #ffffff;
        font-size: 14px;
    }

    .es-header-body a {
        color: #ffffff;
        font-size: 14px;
    }

    .es-footer {
        background-color: transparent;
        background-image: ;
        background-repeat: repeat;
        background-position: center top;
    }

    .es-footer-body {
        background-color: #ffffff;
    }

    .es-footer-body p,
    .es-footer-body ul li,
    .es-footer-body ol li {
        color: #333333;
        font-size: 14px;
    }

    .es-footer-body a {
        color: #333333;
        font-size: 14px;
    }

    .es-infoblock p,
    .es-infoblock ul li,
    .es-infoblock ol li {
        line-height: 120%;
        font-size: 12px;
        color: #cccccc;
    }

    .es-infoblock a {
        font-size: 12px;
        color: #cccccc;
    }


    /* RESPONSIVE STYLES Please do not delete and edit CSS styles below. If you don't need responsive layout, please delete this section. */
    @media only screen and (max-width: 600px) {

        p,
        ul li,
        ol li,
        a {
            font-size: 16px !important;
            line-height: 150% !important;
        }

        h1 {
            font-size: 32px !important;
            text-align: center;
            line-height: 120% !important;
        }

        h2 {
            font-size: 26px !important;
            text-align: center;
            line-height: 120% !important;
        }

        h3 {
            font-size: 20px !important;
            text-align: center;
            line-height: 120% !important;
        }

        h1 a {
            font-size: 32px !important;
        }

        h2 a {
            font-size: 26px !important;
        }

        h3 a {
            font-size: 20px !important;
        }

        .es-menu td a {
            font-size: 16px !important;
        }

        .es-header-body p,
        .es-header-body ul li,
        .es-header-body ol li,
        .es-header-body a {
            font-size: 16px !important;
        }

        .es-footer-body p,
        .es-footer-body ul li,
        .es-footer-body ol li,
        .es-footer-body a {
            font-size: 16px !important;
        }

        .es-infoblock p,
        .es-infoblock ul li,
        .es-infoblock ol li,
        .es-infoblock a {
            font-size: 12px !important;
        }

        *[class="gmail-fix"] {
            display: none !important;
        }

        .es-m-txt-c h1,
        .es-m-txt-c h2,
        .es-m-txt-c h3 {
            text-align: center !important;
        }

        .es-m-txt-r h1,
        .es-m-txt-r h2,
        .es-m-txt-r h3 {
            text-align: right !important;
        }

        .es-m-txt-l h1,
        .es-m-txt-l h2,
        .es-m-txt-l h3 {
            text-align: left !important;
        }

        .es-m-txt-r img,
        .es-m-txt-c img,
        .es-m-txt-l img {
            display: inline !important;
        }

        .es-adaptive table {
            width: 100% !important;
        }

        .es-content table,
        .es-header table,
        .es-footer table,
        .es-content,
        .es-footer {
            padding-right: 0 !important;
        }

        .es-m-p20b {
            padding-bottom: 20px !important;
        }

        .es-hidden {
            display: none !important;
        }

        table.es-social td {
            display: inline-block !important;
        }
    }

    /* END RESPONSIVE STYLES */
</style>
