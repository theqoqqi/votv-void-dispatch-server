import fs from 'fs';
import path from 'path';
import axios from 'axios';
import * as http from 'node:http';

const SHIM_DIR = './';
const REQUESTS_DIR = path.join(SHIM_DIR, 'Requests');
const RESPONSES_DIR = path.join(SHIM_DIR, 'Responses');

async function processRequestFile(fileName) {
    const filePath = path.join(REQUESTS_DIR, fileName);
    const content = await fs.promises.readFile(filePath, 'utf-8');

    const requestData = parseFlatStruct(content);
    const responseJson = await getResponseData(requestData);
    const responseData = buildFlatStruct(responseJson);

    const responseFilePath = path.join(RESPONSES_DIR, fileName);
    const fileContent = createResponseFileContent(responseData, 200);

    await fs.promises.writeFile(responseFilePath, fileContent, 'utf-8');
    await fs.promises.unlink(filePath);
}

async function getResponseData(data) {
    console.log(`${data.method} ${data.url}...`);

    try {
        if (data.method === 'GET') {
            const params = extractPrefixedKeys(data, 'query.');
            const response = await axios.get(data.url, {
                httpAgent: getHttpAgent(),
                params,
            });

            return response.data;
        } else if (data.method === 'POST') {
            const requestData = extractPrefixedKeys(data, 'formData.');
            const response = await axios.post(data.url, requestData, {
                httpAgent: getHttpAgent(),
            });

            return response.data;
        } else {
            return {
                error: 'Unsupported method'
            };
        }
    } catch (error) {
        return {
            error: error.message
        };
    }
}

function getHttpAgent() {
    return new http.Agent({
        family: 4,
    });
}

function parseFlatStruct(content) {
    const data = {};

    for (let line of content.split(/\r?\n/)) {
        line = line.trim();

        if (!line || line.startsWith('#')) {
            continue;
        }

        const [key, ...rest] = line.split('=');

        data[key.trim()] = rest.join('=').trim();
    }

    return data;
}

function createResponseFileContent(data, status) {
    const content = {};

    content['status'] = String(status);

    for (const [key, value] of Object.entries(data)) {
        content[`body.${key}`] = String(value);
    }

    return stringifyFlatStruct(content);
}

function buildFlatStruct(obj, parentKey = '', result = {}) {
    if (Array.isArray(obj)) {
        obj.forEach((item, index) => {
            const newKey = parentKey ? `${parentKey}.${index}` : `${index}`;

            if (typeof item === 'object' && item !== null) {
                buildFlatStruct(item, newKey, result);
            } else {
                result[newKey] = item;
            }
        });
    } else if (typeof obj === 'object' && obj !== null) {
        for (const [key, value] of Object.entries(obj)) {
            const newKey = parentKey ? `${parentKey}.${key}` : key;

            if (typeof value === 'object' && value !== null) {
                buildFlatStruct(value, newKey, result);
            } else {
                result[newKey] = value;
            }
        }
    }
    return result;
}

function stringifyFlatStruct(flatStruct) {
    return Object.entries(flatStruct)
        .map(([k, v]) => `${k}=${v}`)
        .join('\n');
}

function extractPrefixedKeys(data, prefix) {
    const result = {};

    for (const key in data) {
        if (key.startsWith(prefix)) {
            const newKey = key.slice(prefix.length);

            result[newKey] = data[key];
        }
    }

    return result;
}

async function watchRequests() {
    if (!fs.existsSync(REQUESTS_DIR)) {
        fs.mkdirSync(REQUESTS_DIR);
    }

    if (!fs.existsSync(RESPONSES_DIR)) {
        fs.mkdirSync(RESPONSES_DIR);
    }

    console.log('Shim server running, watching Requests folder...');

    // noinspection InfiniteLoopJS
    while (true) {
        await handleRequestFiles();
        await removeEmptyResponseFiles();
        await sleep(100);
    }
}

async function handleRequestFiles() {
    const files = await fs.promises.readdir(REQUESTS_DIR);

    for (const file of files) {
        if (file.endsWith('.txt')) {
            try {
                await processRequestFile(file);
            } catch (err) {
                console.error(`Error processing request file ${file}:`, err);
            }
        }
    }
}

async function removeEmptyResponseFiles() {
    if (!fs.existsSync(RESPONSES_DIR)) return;

    const files = await fs.promises.readdir(RESPONSES_DIR);

    for (const file of files) {
        const filePath = path.join(RESPONSES_DIR, file);

        try {
            const stats = await fs.promises.stat(filePath);

            if (stats.size === 0) {
                await fs.promises.unlink(filePath);
            }
        } catch (err) {
            console.error(`Error checking/deleting file ${file}:`, err);
        }
    }
}

async function sleep(ms) {
    return new Promise(r => setTimeout(r, ms));
}

// noinspection JSIgnoredPromiseFromCall
watchRequests();
