-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 24, 2019 at 11:40 AM
-- Server version: 5.7.26-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnuaefvp_enfinity`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `account_id` int(11) NOT NULL,
  `account_member` int(11) NOT NULL,
  `account_upline` int(11) DEFAULT NULL,
  `account_sponsor` int(11) DEFAULT NULL,
  `account_referee` int(11) NOT NULL,
  `account_level` int(11) DEFAULT NULL,
  `account_side` varchar(20) DEFAULT NULL,
  `account_pincode` varchar(20) NOT NULL,
  `account_status` varchar(20) NOT NULL,
  `account_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `balance_id` int(11) NOT NULL,
  `balance_account` int(11) NOT NULL,
  `balance_matching` float NOT NULL DEFAULT '0',
  `balance_commission` float NOT NULL DEFAULT '0',
  `balance_upgrade` float NOT NULL DEFAULT '0',
  `balance_daily_sponsor` float NOT NULL DEFAULT '0',
  `balance_direct_sponsors` float NOT NULL DEFAULT '0',
  `balance_all` float NOT NULL DEFAULT '0',
  `balance_encashed` float NOT NULL DEFAULT '0',
  `balance_total` float NOT NULL DEFAULT '0',
  `balance_status` varchar(10) NOT NULL,
  `balance_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `num_code` int(3) NOT NULL DEFAULT '0',
  `alpha_2_code` varchar(2) DEFAULT NULL,
  `alpha_3_code` varchar(3) DEFAULT NULL,
  `en_short_name` varchar(52) DEFAULT NULL,
  `nationality` varchar(39) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'normal'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`num_code`, `alpha_2_code`, `alpha_3_code`, `en_short_name`, `nationality`, `status`) VALUES
(4, 'AF', 'AFG', 'Afghanistan', 'Afghan', 'normal'),
(8, 'AL', 'ALB', 'Albania', 'Albanian', 'normal'),
(10, 'AQ', 'ATA', 'Antarctica', 'Antarctic', 'normal'),
(12, 'DZ', 'DZA', 'Algeria', 'Algerian', 'normal'),
(16, 'AS', 'ASM', 'American Samoa', 'American Samoan', 'normal'),
(20, 'AD', 'AND', 'Andorra', 'Andorran', 'normal'),
(24, 'AO', 'AGO', 'Angola', 'Angolan', 'normal'),
(28, 'AG', 'ATG', 'Antigua and Barbuda', 'Antiguan or Barbudan', 'normal'),
(31, 'AZ', 'AZE', 'Azerbaijan', 'Azerbaijani, Azeri', 'normal'),
(32, 'AR', 'ARG', 'Argentina', 'Argentine', 'normal'),
(36, 'AU', 'AUS', 'Australia', 'Australian', 'normal'),
(40, 'AT', 'AUT', 'Austria', 'Austrian', 'normal'),
(44, 'BS', 'BHS', 'Bahamas', 'Bahamian', 'normal'),
(48, 'BH', 'BHR', 'Bahrain', 'Bahraini', 'normal'),
(50, 'BD', 'BGD', 'Bangladesh', 'Bangladeshi', 'normal'),
(51, 'AM', 'ARM', 'Armenia', 'Armenian', 'normal'),
(52, 'BB', 'BRB', 'Barbados', 'Barbadian', 'normal'),
(56, 'BE', 'BEL', 'Belgium', 'Belgian', 'normal'),
(60, 'BM', 'BMU', 'Bermuda', 'Bermudian, Bermudan', 'normal'),
(64, 'BT', 'BTN', 'Bhutan', 'Bhutanese', 'normal'),
(68, 'BO', 'BOL', 'Bolivia (Plurinational State of)', 'Bolivian', 'normal'),
(70, 'BA', 'BIH', 'Bosnia and Herzegovina', 'Bosnian or Herzegovinian', 'normal'),
(72, 'BW', 'BWA', 'Botswana', 'Motswana, Botswanan', 'normal'),
(74, 'BV', 'BVT', 'Bouvet Island', 'Bouvet Island', 'normal'),
(76, 'BR', 'BRA', 'Brazil', 'Brazilian', 'normal'),
(84, 'BZ', 'BLZ', 'Belize', 'Belizean', 'normal'),
(86, 'IO', 'IOT', 'British Indian Ocean Territory', 'BIOT', 'normal'),
(90, 'SB', 'SLB', 'Solomon Islands', 'Solomon Island', 'normal'),
(92, 'VG', 'VGB', 'Virgin Islands (British)', 'British Virgin Island', 'normal'),
(96, 'BN', 'BRN', 'Brunei Darussalam', 'Bruneian', 'normal'),
(100, 'BG', 'BGR', 'Bulgaria', 'Bulgarian', 'normal'),
(104, 'MM', 'MMR', 'Myanmar', 'Burmese', 'normal'),
(108, 'BI', 'BDI', 'Burundi', 'Burundian', 'normal'),
(112, 'BY', 'BLR', 'Belarus', 'Belarusian', 'normal'),
(116, 'KH', 'KHM', 'Cambodia', 'Cambodian', 'normal'),
(120, 'CM', 'CMR', 'Cameroon', 'Cameroonian', 'normal'),
(124, 'CA', 'CAN', 'Canada', 'Canadian', 'normal'),
(132, 'CV', 'CPV', 'Cabo Verde', 'Cabo Verdean', 'normal'),
(136, 'KY', 'CYM', 'Cayman Islands', 'Caymanian', 'normal'),
(140, 'CF', 'CAF', 'Central African Republic', 'Central African', 'normal'),
(144, 'LK', 'LKA', 'Sri Lanka', 'Sri Lankan', 'normal'),
(148, 'TD', 'TCD', 'Chad', 'Chadian', 'normal'),
(152, 'CL', 'CHL', 'Chile', 'Chilean', 'normal'),
(156, 'CN', 'CHN', 'China', 'Chinese', 'normal'),
(158, 'TW', 'TWN', 'Taiwan, Province of China', 'Chinese, Taiwanese', 'normal'),
(162, 'CX', 'CXR', 'Christmas Island', 'Christmas Island', 'normal'),
(166, 'CC', 'CCK', 'Cocos (Keeling) Islands', 'Cocos Island', 'normal'),
(170, 'CO', 'COL', 'Colombia', 'Colombian', 'normal'),
(174, 'KM', 'COM', 'Comoros', 'Comoran, Comorian', 'normal'),
(175, 'YT', 'MYT', 'Mayotte', 'Mahoran', 'normal'),
(178, 'CG', 'COG', 'Congo (Republic of the)', 'Congolese', 'normal'),
(180, 'CD', 'COD', 'Congo (Democratic Republic of the)', 'Congolese', 'normal'),
(184, 'CK', 'COK', 'Cook Islands', 'Cook Island', 'normal'),
(188, 'CR', 'CRI', 'Costa Rica', 'Costa Rican', 'normal'),
(191, 'HR', 'HRV', 'Croatia', 'Croatian', 'normal'),
(192, 'CU', 'CUB', 'Cuba', 'Cuban', 'normal'),
(196, 'CY', 'CYP', 'Cyprus', 'Cypriot', 'normal'),
(203, 'CZ', 'CZE', 'Czech Republic', 'Czech', 'normal'),
(204, 'BJ', 'BEN', 'Benin', 'Beninese, Beninois', 'normal'),
(208, 'DK', 'DNK', 'Denmark', 'Danish', 'normal'),
(212, 'DM', 'DMA', 'Dominica', 'Dominican', 'normal'),
(214, 'DO', 'DOM', 'Dominican Republic', 'Dominican', 'normal'),
(218, 'EC', 'ECU', 'Ecuador', 'Ecuadorian', 'normal'),
(222, 'SV', 'SLV', 'El Salvador', 'Salvadoran', 'normal'),
(226, 'GQ', 'GNQ', 'Equatorial Guinea', 'Equatorial Guinean, Equatoguinean', 'normal'),
(231, 'ET', 'ETH', 'Ethiopia', 'Ethiopian', 'normal'),
(232, 'ER', 'ERI', 'Eritrea', 'Eritrean', 'normal'),
(233, 'EE', 'EST', 'Estonia', 'Estonian', 'normal'),
(234, 'FO', 'FRO', 'Faroe Islands', 'Faroese', 'normal'),
(238, 'FK', 'FLK', 'Falkland Islands (Malvinas)', 'Falkland Island', 'normal'),
(239, 'GS', 'SGS', 'South Georgia and the South Sandwich Islands', 'South Georgia or South Sandwich Islands', 'normal'),
(242, 'FJ', 'FJI', 'Fiji', 'Fijian', 'normal'),
(246, 'FI', 'FIN', 'Finland', 'Finnish', 'normal'),
(248, 'AX', 'ALA', 'Åland Islands', 'Åland Island', 'normal'),
(250, 'FR', 'FRA', 'France', 'French', 'normal'),
(254, 'GF', 'GUF', 'French Guiana', 'French Guianese', 'normal'),
(258, 'PF', 'PYF', 'French Polynesia', 'French Polynesian', 'normal'),
(260, 'TF', 'ATF', 'French Southern Territories', 'French Southern Territories', 'normal'),
(262, 'DJ', 'DJI', 'Djibouti', 'Djiboutian', 'normal'),
(266, 'GA', 'GAB', 'Gabon', 'Gabonese', 'normal'),
(268, 'GE', 'GEO', 'Georgia', 'Georgian', 'normal'),
(270, 'GM', 'GMB', 'Gambia', 'Gambian', 'normal'),
(275, 'PS', 'PSE', 'Palestine, State of', 'Palestinian', 'normal'),
(276, 'DE', 'DEU', 'Germany', 'German', 'normal'),
(288, 'GH', 'GHA', 'Ghana', 'Ghanaian', 'normal'),
(292, 'GI', 'GIB', 'Gibraltar', 'Gibraltar', 'normal'),
(296, 'KI', 'KIR', 'Kiribati', 'I-Kiribati', 'normal'),
(300, 'GR', 'GRC', 'Greece', 'Greek, Hellenic', 'normal'),
(304, 'GL', 'GRL', 'Greenland', 'Greenlandic', 'normal'),
(308, 'GD', 'GRD', 'Grenada', 'Grenadian', 'normal'),
(312, 'GP', 'GLP', 'Guadeloupe', 'Guadeloupe', 'normal'),
(316, 'GU', 'GUM', 'Guam', 'Guamanian, Guambat', 'normal'),
(320, 'GT', 'GTM', 'Guatemala', 'Guatemalan', 'normal'),
(324, 'GN', 'GIN', 'Guinea', 'Guinean', 'normal'),
(328, 'GY', 'GUY', 'Guyana', 'Guyanese', 'normal'),
(332, 'HT', 'HTI', 'Haiti', 'Haitian', 'normal'),
(334, 'HM', 'HMD', 'Heard Island and McDonald Islands', 'Heard Island or McDonald Islands', 'normal'),
(336, 'VA', 'VAT', 'Vatican City State', 'Vatican', 'normal'),
(340, 'HN', 'HND', 'Honduras', 'Honduran', 'normal'),
(344, 'HK', 'HKG', 'Hong Kong', 'Hong Kong, Hong Kongese', 'normal'),
(348, 'HU', 'HUN', 'Hungary', 'Hungarian, Magyar', 'normal'),
(352, 'IS', 'ISL', 'Iceland', 'Icelandic', 'normal'),
(356, 'IN', 'IND', 'India', 'Indian', 'normal'),
(360, 'ID', 'IDN', 'Indonesia', 'Indonesian', 'normal'),
(364, 'IR', 'IRN', 'Iran', 'Iranian, Persian', 'normal'),
(368, 'IQ', 'IRQ', 'Iraq', 'Iraqi', 'normal'),
(372, 'IE', 'IRL', 'Ireland', 'Irish', 'normal'),
(376, 'IL', 'ISR', 'Israel', 'Israeli', 'normal'),
(380, 'IT', 'ITA', 'Italy', 'Italian', 'normal'),
(384, 'CI', 'CIV', 'Côte d\'Ivoire', 'Ivorian', 'normal'),
(388, 'JM', 'JAM', 'Jamaica', 'Jamaican', 'normal'),
(392, 'JP', 'JPN', 'Japan', 'Japanese', 'normal'),
(398, 'KZ', 'KAZ', 'Kazakhstan', 'Kazakhstani, Kazakh', 'normal'),
(400, 'JO', 'JOR', 'Jordan', 'Jordanian', 'normal'),
(404, 'KE', 'KEN', 'Kenya', 'Kenyan', 'normal'),
(408, 'KP', 'PRK', 'Korea (Democratic People\'s Republic of)', 'North Korean', 'normal'),
(410, 'KR', 'KOR', 'Korea (Republic of)', 'South Korean', 'normal'),
(414, 'KW', 'KWT', 'Kuwait', 'Kuwaiti', 'normal'),
(417, 'KG', 'KGZ', 'Kyrgyzstan', 'Kyrgyzstani, Kyrgyz, Kirgiz, Kirghiz', 'normal'),
(418, 'LA', 'LAO', 'Lao People\'s Democratic Republic', 'Lao, Laotian', 'normal'),
(422, 'LB', 'LBN', 'Lebanon', 'Lebanese', 'normal'),
(426, 'LS', 'LSO', 'Lesotho', 'Basotho', 'normal'),
(428, 'LV', 'LVA', 'Latvia', 'Latvian', 'normal'),
(430, 'LR', 'LBR', 'Liberia', 'Liberian', 'normal'),
(434, 'LY', 'LBY', 'Libya', 'Libyan', 'normal'),
(438, 'LI', 'LIE', 'Liechtenstein', 'Liechtenstein', 'normal'),
(440, 'LT', 'LTU', 'Lithuania', 'Lithuanian', 'normal'),
(442, 'LU', 'LUX', 'Luxembourg', 'Luxembourg, Luxembourgish', 'normal'),
(446, 'MO', 'MAC', 'Macao', 'Macanese, Chinese', 'normal'),
(450, 'MG', 'MDG', 'Madagascar', 'Malagasy', 'normal'),
(454, 'MW', 'MWI', 'Malawi', 'Malawian', 'normal'),
(458, 'MY', 'MYS', 'Malaysia', 'Malaysian', 'normal'),
(462, 'MV', 'MDV', 'Maldives', 'Maldivian', 'normal'),
(466, 'ML', 'MLI', 'Mali', 'Malian, Malinese', 'normal'),
(470, 'MT', 'MLT', 'Malta', 'Maltese', 'normal'),
(474, 'MQ', 'MTQ', 'Martinique', 'Martiniquais, Martinican', 'normal'),
(478, 'MR', 'MRT', 'Mauritania', 'Mauritanian', 'normal'),
(480, 'MU', 'MUS', 'Mauritius', 'Mauritian', 'normal'),
(484, 'MX', 'MEX', 'Mexico', 'Mexican', 'normal'),
(492, 'MC', 'MCO', 'Monaco', 'Monégasque, Monacan', 'normal'),
(496, 'MN', 'MNG', 'Mongolia', 'Mongolian', 'normal'),
(498, 'MD', 'MDA', 'Moldova (Republic of)', 'Moldovan', 'normal'),
(499, 'ME', 'MNE', 'Montenegro', 'Montenegrin', 'normal'),
(500, 'MS', 'MSR', 'Montserrat', 'Montserratian', 'normal'),
(504, 'MA', 'MAR', 'Morocco', 'Moroccan', 'normal'),
(508, 'MZ', 'MOZ', 'Mozambique', 'Mozambican', 'normal'),
(512, 'OM', 'OMN', 'Oman', 'Omani', 'normal'),
(516, 'NA', 'NAM', 'Namibia', 'Namibian', 'normal'),
(520, 'NR', 'NRU', 'Nauru', 'Nauruan', 'normal'),
(524, 'NP', 'NPL', 'Nepal', 'Nepali, Nepalese', 'normal'),
(528, 'NL', 'NLD', 'Netherlands', 'Dutch, Netherlandic', 'normal'),
(531, 'CW', 'CUW', 'Curaçao', 'Curaçaoan', 'normal'),
(533, 'AW', 'ABW', 'Aruba', 'Aruban', 'normal'),
(534, 'SX', 'SXM', 'Sint Maarten (Dutch part)', 'Sint Maarten', 'normal'),
(535, 'BQ', 'BES', 'Bonaire, Sint Eustatius and Saba', 'Bonaire', 'normal'),
(540, 'NC', 'NCL', 'New Caledonia', 'New Caledonian', 'normal'),
(548, 'VU', 'VUT', 'Vanuatu', 'Ni-Vanuatu, Vanuatuan', 'normal'),
(554, 'NZ', 'NZL', 'New Zealand', 'New Zealand, NZ', 'normal'),
(558, 'NI', 'NIC', 'Nicaragua', 'Nicaraguan', 'normal'),
(562, 'NE', 'NER', 'Niger', 'Nigerien', 'normal'),
(566, 'NG', 'NGA', 'Nigeria', 'Nigerian', 'normal'),
(570, 'NU', 'NIU', 'Niue', 'Niuean', 'normal'),
(574, 'NF', 'NFK', 'Norfolk Island', 'Norfolk Island', 'normal'),
(578, 'NO', 'NOR', 'Norway', 'Norwegian', 'normal'),
(580, 'MP', 'MNP', 'Northern Mariana Islands', 'Northern Marianan', 'normal'),
(581, 'UM', 'UMI', 'United States Minor Outlying Islands', 'American', 'normal'),
(583, 'FM', 'FSM', 'Micronesia (Federated States of)', 'Micronesian', 'normal'),
(584, 'MH', 'MHL', 'Marshall Islands', 'Marshallese', 'normal'),
(585, 'PW', 'PLW', 'Palau', 'Palauan', 'normal'),
(586, 'PK', 'PAK', 'Pakistan', 'Pakistani', 'normal'),
(591, 'PA', 'PAN', 'Panama', 'Panamanian', 'normal'),
(598, 'PG', 'PNG', 'Papua New Guinea', 'Papua New Guinean, Papuan', 'normal'),
(600, 'PY', 'PRY', 'Paraguay', 'Paraguayan', 'normal'),
(604, 'PE', 'PER', 'Peru', 'Peruvian', 'normal'),
(608, 'PH', 'PHL', 'Philippines', 'Philippine, Filipino', 'normal'),
(612, 'PN', 'PCN', 'Pitcairn', 'Pitcairn Island', 'normal'),
(616, 'PL', 'POL', 'Poland', 'Polish', 'normal'),
(620, 'PT', 'PRT', 'Portugal', 'Portuguese', 'normal'),
(624, 'GW', 'GNB', 'Guinea-Bissau', 'Bissau-Guinean', 'normal'),
(626, 'TL', 'TLS', 'Timor-Leste', 'Timorese', 'normal'),
(630, 'PR', 'PRI', 'Puerto Rico', 'Puerto Rican', 'normal'),
(634, 'QA', 'QAT', 'Qatar', 'Qatari', 'normal'),
(638, 'RE', 'REU', 'Réunion', 'Réunionese, Réunionnais', 'normal'),
(642, 'RO', 'ROU', 'Romania', 'Romanian', 'normal'),
(643, 'RU', 'RUS', 'Russian Federation', 'Russian', 'normal'),
(646, 'RW', 'RWA', 'Rwanda', 'Rwandan', 'normal'),
(652, 'BL', 'BLM', 'Saint Barthélemy', 'Barthélemois', 'normal'),
(654, 'SH', 'SHN', 'Saint Helena, Ascension and Tristan da Cunha', 'Saint Helenian', 'normal'),
(659, 'KN', 'KNA', 'Saint Kitts and Nevis', 'Kittitian or Nevisian', 'normal'),
(660, 'AI', 'AIA', 'Anguilla', 'Anguillan', 'normal'),
(662, 'LC', 'LCA', 'Saint Lucia', 'Saint Lucian', 'normal'),
(663, 'MF', 'MAF', 'Saint Martin (French part)', 'Saint-Martinoise', 'normal'),
(666, 'PM', 'SPM', 'Saint Pierre and Miquelon', 'Saint-Pierrais or Miquelonnais', 'normal'),
(670, 'VC', 'VCT', 'Saint Vincent and the Grenadines', 'Saint Vincentian, Vincentian', 'normal'),
(674, 'SM', 'SMR', 'San Marino', 'Sammarinese', 'normal'),
(678, 'ST', 'STP', 'Sao Tome and Principe', 'São Toméan', 'normal'),
(682, 'SA', 'SAU', 'Saudi Arabia', 'Saudi, Saudi Arabian', 'normal'),
(686, 'SN', 'SEN', 'Senegal', 'Senegalese', 'normal'),
(688, 'RS', 'SRB', 'Serbia', 'Serbian', 'normal'),
(690, 'SC', 'SYC', 'Seychelles', 'Seychellois', 'normal'),
(694, 'SL', 'SLE', 'Sierra Leone', 'Sierra Leonean', 'normal'),
(702, 'SG', 'SGP', 'Singapore', 'Singaporean', 'normal'),
(703, 'SK', 'SVK', 'Slovakia', 'Slovak', 'normal'),
(704, 'VN', 'VNM', 'Vietnam', 'Vietnamese', 'normal'),
(705, 'SI', 'SVN', 'Slovenia', 'Slovenian, Slovene', 'normal'),
(706, 'SO', 'SOM', 'Somalia', 'Somali, Somalian', 'normal'),
(710, 'ZA', 'ZAF', 'South Africa', 'South African', 'normal'),
(716, 'ZW', 'ZWE', 'Zimbabwe', 'Zimbabwean', 'normal'),
(724, 'ES', 'ESP', 'Spain', 'Spanish', 'normal'),
(728, 'SS', 'SSD', 'South Sudan', 'South Sudanese', 'normal'),
(729, 'SD', 'SDN', 'Sudan', 'Sudanese', 'normal'),
(732, 'EH', 'ESH', 'Western Sahara', 'Sahrawi, Sahrawian, Sahraouian', 'normal'),
(740, 'SR', 'SUR', 'Suriname', 'Surinamese', 'normal'),
(744, 'SJ', 'SJM', 'Svalbard and Jan Mayen', 'Svalbard', 'normal'),
(748, 'SZ', 'SWZ', 'Swaziland', 'Swazi', 'normal'),
(752, 'SE', 'SWE', 'Sweden', 'Swedish', 'normal'),
(756, 'CH', 'CHE', 'Switzerland', 'Swiss', 'normal'),
(760, 'SY', 'SYR', 'Syrian Arab Republic', 'Syrian', 'normal'),
(762, 'TJ', 'TJK', 'Tajikistan', 'Tajikistani', 'normal'),
(764, 'TH', 'THA', 'Thailand', 'Thai', 'normal'),
(768, 'TG', 'TGO', 'Togo', 'Togolese', 'normal'),
(772, 'TK', 'TKL', 'Tokelau', 'Tokelauan', 'normal'),
(776, 'TO', 'TON', 'Tonga', 'Tongan', 'normal'),
(780, 'TT', 'TTO', 'Trinidad and Tobago', 'Trinidadian or Tobagonian', 'normal'),
(784, 'AE', 'ARE', 'United Arab Emirates', 'Emirati, Emirian, Emiri', 'normal'),
(788, 'TN', 'TUN', 'Tunisia', 'Tunisian', 'normal'),
(792, 'TR', 'TUR', 'Turkey', 'Turkish', 'normal'),
(795, 'TM', 'TKM', 'Turkmenistan', 'Turkmen', 'normal'),
(796, 'TC', 'TCA', 'Turks and Caicos Islands', 'Turks and Caicos Island', 'normal'),
(798, 'TV', 'TUV', 'Tuvalu', 'Tuvaluan', 'normal'),
(800, 'UG', 'UGA', 'Uganda', 'Ugandan', 'normal'),
(804, 'UA', 'UKR', 'Ukraine', 'Ukrainian', 'normal'),
(807, 'MK', 'MKD', 'Macedonia (the former Yugoslav Republic of)', 'Macedonian', 'normal'),
(818, 'EG', 'EGY', 'Egypt', 'Egyptian', 'normal'),
(826, 'GB', 'GBR', 'United Kingdom of Great Britain and Northern Ireland', 'British, UK', 'normal'),
(831, 'GG', 'GGY', 'Guernsey', 'Channel Island', 'normal'),
(832, 'JE', 'JEY', 'Jersey', 'Channel Island', 'normal'),
(833, 'IM', 'IMN', 'Isle of Man', 'Manx', 'normal'),
(834, 'TZ', 'TZA', 'Tanzania, United Republic of', 'Tanzanian', 'normal'),
(840, 'US', 'USA', 'United States of America', 'American', 'normal'),
(850, 'VI', 'VIR', 'Virgin Islands (U.S.)', 'U.S. Virgin Island', 'normal'),
(854, 'BF', 'BFA', 'Burkina Faso', 'Burkinabé', 'normal'),
(858, 'UY', 'URY', 'Uruguay', 'Uruguayan', 'normal'),
(860, 'UZ', 'UZB', 'Uzbekistan', 'Uzbekistani, Uzbek', 'normal'),
(862, 'VE', 'VEN', 'Venezuela (Bolivarian Republic of)', 'Venezuelan', 'normal'),
(876, 'WF', 'WLF', 'Wallis and Futuna', 'Wallis and Futuna, Wallisian or Futunan', 'normal'),
(882, 'WS', 'WSM', 'Samoa', 'Samoan', 'normal'),
(887, 'YE', 'YEM', 'Yemen', 'Yemeni', 'normal'),
(894, 'ZM', 'ZMB', 'Zambia', 'Zambian', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `employee_fname` varchar(50) NOT NULL,
  `employee_lname` varchar(50) NOT NULL,
  `employee_branch` varchar(50) NOT NULL,
  `employee_category` varchar(50) NOT NULL,
  `employee_dob` varchar(20) NOT NULL,
  `employee_nid` varchar(30) NOT NULL,
  `employee_phone` varchar(20) NOT NULL,
  `employee_gender` varchar(7) NOT NULL,
  `employee_email` varchar(100) NOT NULL,
  `employee_country` varchar(30) NOT NULL,
  `employee_city` varchar(30) NOT NULL,
  `employee_bank_account` varchar(50) NOT NULL,
  `employee_bank_name` varchar(30) NOT NULL,
  `employee_username` text NOT NULL,
  `employee_password` text NOT NULL,
  `employee_password_key` text NOT NULL,
  `employee_status` varchar(30) NOT NULL,
  `employee_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `employee_pwd_change` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encashment`
--

CREATE TABLE `encashment` (
  `encash_id` int(11) NOT NULL,
  `encash_account` int(11) NOT NULL,
  `encash_net_income` float NOT NULL DEFAULT '0',
  `encash_tax` float NOT NULL DEFAULT '0',
  `encash_sys_fees` float NOT NULL DEFAULT '0',
  `encash_before` float NOT NULL DEFAULT '0',
  `encash_remain` float NOT NULL DEFAULT '0',
  `encash_gross_income` float NOT NULL DEFAULT '0',
  `encash_type` int(11) DEFAULT NULL,
  `encash_status` varchar(10) NOT NULL,
  `encash_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encash_method`
--

CREATE TABLE `encash_method` (
  `encash_method_id` int(11) NOT NULL,
  `encash_method_account` int(11) NOT NULL,
  `encash_method_equity` varchar(50) DEFAULT NULL,
  `encash_method_mobile` varchar(20) DEFAULT NULL,
  `encash_method_status` varchar(10) NOT NULL,
  `encash_method_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `fees_id` int(11) NOT NULL,
  `fees_system` float DEFAULT NULL,
  `fees_tax` float DEFAULT NULL,
  `fees_register` float NOT NULL,
  `fees_many_accounts` float NOT NULL DEFAULT '0',
  `fees_more_sponsors` float NOT NULL DEFAULT '0',
  `fees_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`fees_id`, `fees_system`, `fees_tax`, `fees_register`, `fees_many_accounts`, `fees_more_sponsors`, `fees_status`) VALUES
(1, 1000, 0.17, 35000, 1000, 1000, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `flashout`
--

CREATE TABLE `flashout` (
  `flashout_id` int(11) NOT NULL,
  `flashed_accounts` int(11) NOT NULL,
  `left_flashed_points` varchar(11) DEFAULT NULL,
  `right_flashed_points` varchar(11) DEFAULT NULL,
  `left_dwnlines` varchar(11) DEFAULT NULL,
  `right_dwnlines` varchar(11) DEFAULT NULL,
  `flashout_status` varchar(20) NOT NULL DEFAULT 'E',
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gain`
--

CREATE TABLE `gain` (
  `gain_id` int(11) NOT NULL,
  `gain_owner` int(11) NOT NULL,
  `gain_category` int(11) NOT NULL,
  `gain_origin` int(11) NOT NULL,
  `gain_level` varchar(255) DEFAULT NULL,
  `gain_default` varchar(255) DEFAULT NULL,
  `gain_status` varchar(10) NOT NULL,
  `gain_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `imcome_id` int(11) NOT NULL,
  `imcome_category` varchar(20) NOT NULL,
  `imcome_value` varchar(255) NOT NULL,
  `imcome_status` varchar(10) NOT NULL,
  `imcome_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`imcome_id`, `imcome_category`, `imcome_value`, `imcome_status`, `imcome_date`) VALUES
(1, 'Commission', '6000', 'E', '2019-07-04 13:05:16'),
(2, 'Commission_bonus', '1000', 'E', '2019-07-15 12:38:53'),
(3, 'Upgrade_one', '8000', 'E', '2019-07-04 13:05:16'),
(4, 'Upgrade_two', '7000', 'E', '2019-07-04 13:05:48'),
(5, 'Upgrade_three', '6000', 'E', '2019-07-04 17:26:09'),
(6, 'Upgrade_four', '5000', 'E', '2019-07-04 17:26:09'),
(7, 'Upgrade_five', '4000', 'E', '2019-07-04 17:26:35'),
(8, 'Upgrade_six', '3000', 'E', '2019-07-15 12:19:07'),
(9, 'Upgrade_seven', '2000', 'E', '2019-07-15 12:19:07'),
(10, 'Upgrade_eight', '1000', 'E', '2019-07-15 12:19:38'),
(11, 'Upgrade_nine', '500', 'E', '2019-07-15 12:19:38'),
(12, 'Upgrade_ten', '500', 'E', '2019-07-15 12:20:03'),
(13, 'Daily_sponsors', '1000', 'E', '2019-07-17 10:58:10'),
(14, 'Direct_many_accounts', '1000', 'E', '2019-07-17 10:58:10');

-- --------------------------------------------------------

--
-- Table structure for table `matching`
--

CREATE TABLE `matching` (
  `matching_id` int(11) NOT NULL,
  `matching_owner` int(11) NOT NULL,
  `matching_left` int(11) NOT NULL DEFAULT '0',
  `matching_right` int(11) NOT NULL DEFAULT '0',
  `matching_rem_left` int(11) NOT NULL DEFAULT '0',
  `matching_rem_right` int(11) NOT NULL DEFAULT '0',
  `matching_earn` int(11) NOT NULL DEFAULT '0',
  `matching_code` int(11) NOT NULL,
  `matching_status` varchar(10) NOT NULL,
  `matching_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `member_fname` varchar(40) NOT NULL,
  `member_lname` varchar(100) NOT NULL,
  `member_dob` varchar(20) DEFAULT NULL,
  `member_nid` varchar(30) DEFAULT NULL,
  `member_phone` varchar(20) NOT NULL,
  `member_gender` varchar(10) DEFAULT NULL,
  `member_email` varchar(150) DEFAULT NULL,
  `member_country` varchar(50) DEFAULT NULL,
  `member_city` varchar(50) DEFAULT NULL,
  `member_bank_account` varchar(50) DEFAULT NULL,
  `member_bank_name` varchar(50) DEFAULT NULL,
  `member_username` varchar(20) DEFAULT NULL,
  `member_password` text,
  `member_password_key` text,
  `member_status` varchar(20) DEFAULT NULL,
  `member_registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member_date_pwd_change` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

CREATE TABLE `points` (
  `points_id` int(11) NOT NULL,
  `account_id` int(10) NOT NULL,
  `left_downlines` varchar(11) DEFAULT NULL,
  `right_downlines` varchar(20) DEFAULT NULL,
  `rem_left_points` varchar(100) DEFAULT NULL,
  `rem_right_points` varchar(100) DEFAULT NULL,
  `matched_account` varchar(11) DEFAULT NULL,
  `status` varchar(11) DEFAULT NULL,
  `dates` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_fname` varchar(20) NOT NULL,
  `staff_lname` varchar(30) NOT NULL,
  `staff_phone` varchar(20) NOT NULL,
  `staff_email` varchar(30) NOT NULL,
  `staff_category` varchar(20) NOT NULL,
  `staff_bank_acount` varchar(30) NOT NULL,
  `staff_bank_name` varchar(30) NOT NULL,
  `staff_nid` varchar(30) NOT NULL,
  `staff_username` varchar(30) NOT NULL,
  `staff_password` text NOT NULL,
  `staff_password_key` text NOT NULL,
  `staff_status` varchar(20) NOT NULL,
  `staff_reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `staff_pwd_change` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_fname`, `staff_lname`, `staff_phone`, `staff_email`, `staff_category`, `staff_bank_acount`, `staff_bank_name`, `staff_nid`, `staff_username`, `staff_password`, `staff_password_key`, `staff_status`, `staff_reg_date`, `staff_pwd_change`) VALUES
(1, 'IGIHOZO', 'Didier', '784424020', 'didierigihozo07@gmail.com', 'Admin', '430074423541', 'Bank of Kigali', '1120008045466576', 'Kabaka', 'kabaka123', 'Kabaka123', 'E', '2019-06-30 08:10:37', '2019-09-25'),
(2, 'Umwiza', 'Anitha', '7877564634', 'anith@gmail.com', 'Reception', '3254354536657', 'Bank of Kigali', '1998383464575673', 'Anitha', 'Anitha123', 'Anitha123', 'E', '2019-06-30 16:36:15', '2019-12-31'),
(3, 'Mugeni', 'Djamillah', '7868745713', 'mugeni@gmail.com', 'Shareholder', '2345635467465756', 'BPR', '119985234879652', 'Mugeni', 'Mugeni123', 'Mugeni123', 'E', '2019-06-30 16:37:43', '2019-12-31'),
(4, 'MUCYO', 'Louis', '7854645334', 'mucyo@gmail.com', 'Accoutant', '453756583200', 'Equity Bank', '11995436356457', 'Louis', 'Louis123', 'Louis123', 'E', '2019-06-30 17:19:12', '2019-11-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`account_id`),
  ADD UNIQUE KEY `account_pincode` (`account_pincode`),
  ADD KEY `account_upline` (`account_upline`,`account_sponsor`),
  ADD KEY `account_referee` (`account_referee`),
  ADD KEY `accounts_ibfk_1` (`account_member`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`balance_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`num_code`),
  ADD UNIQUE KEY `alpha_2_code` (`alpha_2_code`),
  ADD UNIQUE KEY `alpha_3_code` (`alpha_3_code`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `staff_branch` (`employee_branch`,`employee_category`);

--
-- Indexes for table `encashment`
--
ALTER TABLE `encashment`
  ADD PRIMARY KEY (`encash_id`);

--
-- Indexes for table `encash_method`
--
ALTER TABLE `encash_method`
  ADD PRIMARY KEY (`encash_method_id`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`fees_id`);

--
-- Indexes for table `flashout`
--
ALTER TABLE `flashout`
  ADD PRIMARY KEY (`flashout_id`);

--
-- Indexes for table `gain`
--
ALTER TABLE `gain`
  ADD PRIMARY KEY (`gain_id`),
  ADD KEY `gain_owner` (`gain_owner`),
  ADD KEY `gain_origin` (`gain_origin`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`imcome_id`);

--
-- Indexes for table `matching`
--
ALTER TABLE `matching`
  ADD PRIMARY KEY (`matching_id`),
  ADD KEY `matching_owner` (`matching_owner`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`points_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encashment`
--
ALTER TABLE `encashment`
  MODIFY `encash_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encash_method`
--
ALTER TABLE `encash_method`
  MODIFY `encash_method_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `fees_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `flashout`
--
ALTER TABLE `flashout`
  MODIFY `flashout_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gain`
--
ALTER TABLE `gain`
  MODIFY `gain_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `imcome_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `matching`
--
ALTER TABLE `matching`
  MODIFY `matching_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `points`
--
ALTER TABLE `points`
  MODIFY `points_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`account_member`) REFERENCES `member` (`member_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gain`
--
ALTER TABLE `gain`
  ADD CONSTRAINT `gain_ibfk_1` FOREIGN KEY (`gain_owner`) REFERENCES `accounts` (`account_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
